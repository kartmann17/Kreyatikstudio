<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PricingPlan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'monthly_price',
        'original_monthly_price',
        'annual_price',
        'original_annual_price',
        'features',
        'is_highlighted',
        'highlight_text',
        'button_text',
        'starting_text',
        'order',
        'is_active',
        'is_custom_plan',
        'custom_plan_text',
        'has_promotion',
        'promotion_text',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_highlighted' => 'boolean',
        'is_custom_plan' => 'boolean',
        'has_promotion' => 'boolean',
        'order' => 'integer',
        'features' => 'array',
        'original_monthly_price' => 'decimal:2',
        'original_annual_price' => 'decimal:2',
    ];

    /**
     * Les accesseurs à ajouter au modèle.
     *
     * @var array
     */
    protected $appends = [
        'yearly_savings',
    ];

    /**
     * Scope pour obtenir uniquement les plans actifs.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour ordonner les plans selon l'ordre défini.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Retourne le plan mis en évidence.
     */
    public function scopeHighlighted($query)
    {
        return $query->where('is_highlighted', true);
    }

    /**
     * Vérifie si le plan est mis en évidence.
     */
    public function isHighlighted()
    {
        return $this->is_highlighted;
    }

    /**
     * Vérifie si c'est un plan sur mesure.
     */
    public function isCustomPlan()
    {
        return $this->is_custom_plan;
    }

    /**
     * Définit les features comme tableau.
     */
    public function setFeaturesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['features'] = json_encode($value);
        } else if (is_string($value)) {
            $features = explode("\n", $value);
            $features = array_map('trim', $features);
            $features = array_filter($features);
            $this->attributes['features'] = json_encode($features);
        }
    }

    /**
     * Calculer l'économie annuelle (montant + pourcentage + formaté)
     *
     * @return array
     */
    public function getYearlySavingsAttribute(): array
    {
        $monthlyPrice = floatval($this->monthly_price ?? 0);
        $annualPrice = floatval($this->annual_price ?? 0);

        $monthlyTotal = $monthlyPrice * 12;
        $savings = $monthlyTotal - $annualPrice;

        return [
            'amount' => max(0, $savings),
            'percentage' => $monthlyTotal > 0 ? round(($savings / $monthlyTotal) * 100) : 0,
            'formatted' => number_format(max(0, $savings), 2) . ' €'
        ];
    }

    /**
     * Prétraiter l'attribut features avant la sérialisation.
     *
     * @param  string|null  $value
     * @return array|null
     */
    public function getFeaturesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    /**
     * Récupérer le prix formaté pour l'affichage mensuel.
     */
    public function getFormattedMonthlyPriceAttribute()
    {
        return number_format($this->monthly_price, 2) . ' €';
    }

    /**
     * Récupérer le prix formaté pour l'affichage annuel.
     */
    public function getFormattedAnnualPriceAttribute()
    {
        return number_format($this->annual_price, 2) . ' €';
    }


    /**
     * Vérifie si le plan a une promotion active.
     */
    public function hasPromotion()
    {
        return $this->has_promotion;
    }

    /**
     * Retourne le prix affiché (remisé ou normal) pour l'affichage mensuel.
     */
    public function getDisplayMonthlyPriceAttribute()
    {
        return $this->has_promotion && $this->original_monthly_price 
            ? $this->original_monthly_price 
            : $this->monthly_price;
    }

    /**
     * Retourne le prix affiché (remisé ou normal) pour l'affichage annuel.
     */
    public function getDisplayAnnualPriceAttribute()
    {
        return $this->has_promotion && $this->original_annual_price 
            ? $this->original_annual_price 
            : $this->annual_price;
    }

    /**
     * Calcule le pourcentage de remise mensuelle.
     */
    public function getMonthlyDiscountPercentageAttribute()
    {
        if (!$this->has_promotion || !$this->original_monthly_price) {
            return 0;
        }
        
        return round((($this->original_monthly_price - $this->monthly_price) / $this->original_monthly_price) * 100);
    }

    /**
     * Calcule le pourcentage de remise annuelle.
     */
    public function getAnnualDiscountPercentageAttribute()
    {
        if (!$this->has_promotion || !$this->original_annual_price) {
            return 0;
        }
        
        return round((($this->original_annual_price - $this->annual_price) / $this->original_annual_price) * 100);
    }

    /**
     * Récupérer tous les plans actifs, triés par ordre.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getActivePlans()
    {
        return self::where('is_active', true)
            ->orderBy('order')
            ->get();
    }
}
