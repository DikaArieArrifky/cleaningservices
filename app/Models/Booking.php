<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'booking_code',
        'service_category_id',
        'service_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'service_date',
        'service_time',
        'service_address',
        'notes',
        'metadata',
        'total_price',
        'status',
        'admin_notes',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'service_date' => 'date',
            'metadata' => 'array',
            'total_price' => 'decimal:2',
        ];
    }

    public const STATUS_PENDING = 'pending';

    public const STATUS_CONFIRMED = 'confirmed';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

    /**
     * @return array<string, string>
     */
    public static function statusOptions(): array
    {
        return [
            self::STATUS_PENDING => 'Menunggu Konfirmasi',
            self::STATUS_CONFIRMED => 'Terkonfirmasi',
            self::STATUS_IN_PROGRESS => 'Sedang Dikerjakan',
            self::STATUS_COMPLETED => 'Selesai',
            self::STATUS_CANCELLED => 'Dibatalkan',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    protected function formattedTotalPrice(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->total_price !== null
                ? 'Rp '.number_format((float) $this->total_price, 0, ',', '.')
                : 'Estimasi di Tempat'
        );
    }

    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn (): string => self::statusOptions()[$this->status] ?? ucfirst($this->status)
        );
    }

    protected function statusBadgeClass(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                return match ($this->status) {
                    self::STATUS_PENDING => 'bg-amber-100 text-amber-800 border-amber-200',
                    self::STATUS_CONFIRMED => 'bg-blue-100 text-blue-800 border-blue-200',
                    self::STATUS_IN_PROGRESS => 'bg-purple-100 text-purple-800 border-purple-200',
                    self::STATUS_COMPLETED => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                    self::STATUS_CANCELLED => 'bg-rose-100 text-rose-800 border-rose-200',
                    default => 'bg-slate-100 text-slate-800 border-slate-200',
                };
            }
        );
    }

    /**
     * Generate pre-filled WhatsApp click-to-chat URL.
     */
    public function getWhatsAppUrl(?string $adminPhone = null): string
    {
        $phone = $adminPhone ?: SiteSetting::get('whatsapp_number', '6281234567890');
        // Clean phone number (replace non-digits, replace leading 0 with 62)
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($cleanPhone, '0')) {
            $cleanPhone = '62'.substr($cleanPhone, 1);
        }

        $serviceTitle = $this->service?->name ?? 'Layanan Kebersihan';
        $categoryTitle = $this->category?->name ?? 'Layanan';
        $dateFormatted = Carbon::parse($this->service_date)->translatedFormat('d F Y');

        $extraLines = '';
        if (! empty($this->metadata)) {
            if (! empty($this->metadata['vehicle_type'])) {
                $extraLines .= "\n🚗 Kendaraan: ".$this->metadata['vehicle_type'].(! empty($this->metadata['vehicle_model']) ? ' ('.$this->metadata['vehicle_model'].')' : '');
            }
            if (! empty($this->metadata['service_location'])) {
                $extraLines .= "\n📍 Tipe Layanan: ".$this->metadata['service_location'];
            }
            if (! empty($this->metadata['property_type'])) {
                $extraLines .= "\n🏠 Properti: ".$this->metadata['property_type'];
            }
            if (! empty($this->metadata['cleaning_focus'])) {
                $extraLines .= "\n✨ Kebutuhan: ".$this->metadata['cleaning_focus'];
            }
        }

        $msg = "Halo Admin Jasmine Services! 👋\n"
             ."Saya ingin mengonfirmasi pemesanan layanan berikut:\n\n"
             ."📋 *Kode Booking*: {$this->booking_code}\n"
             ."👤 *Nama*: {$this->customer_name}\n"
             ."📱 *WhatsApp*: {$this->customer_phone}\n"
             ."🏷️ *Kategori*: {$categoryTitle}\n"
             ."🛠️ *Layanan*: {$serviceTitle}\n"
             ."📅 *Jadwal*: {$dateFormatted} jam {$this->service_time} WIB\n"
             ."📍 *Alamat*: {$this->service_address}"
             .$extraLines."\n"
             .($this->notes ? "💬 *Catatan*: {$this->notes}\n" : '')
             ."\nMohon konfirmasi dan info ketersediaan slotnya. Terima kasih!";

        return 'https://api.whatsapp.com/send?phone='.$cleanPhone.'&text='.urlencode($msg);
    }

    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }
}
