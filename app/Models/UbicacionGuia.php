<?php
// app/Models/UbicacionGuia.php
class UbicacionGuia extends Model
{
    protected $fillable = ['guia_id', 'latitud', 'longitud', 'descripcion'];

    public function guia()
    {
        return $this->belongsTo(Guia::class);
    }
    public function ubicaciones()
{
    return $this->hasMany(UbicacionGuia::class)->orderBy('created_at');
}

public function ultimaUbicacion()
{
    return $this->hasOne(UbicacionGuia::class)->latestOfMany();
}
}
