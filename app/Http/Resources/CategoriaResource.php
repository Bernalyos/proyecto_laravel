<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
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
            'descripcion' => $this->descripcion,
            'fecha_creacion' => $this->created_at->format('Y-m-d H:i:s'),
            'productos_count' => $this->whenCounted('productos'),
            'productos' => ProductoResource::collection($this->whenLoaded('productos'))
        ];
    }
}
