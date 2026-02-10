<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'precio' => (float) $this->precio,
            'stock' => (int) $this->stock,
            'imagen_url' => $this->imagen_url ? asset('storage/' . $this->imagen_url) : null,
            'categoria' => new CategoriaResource($this->whenLoaded('categoria')),
            'fecha_creacion' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
