<?php

namespace Tests\Unit;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_belongs_to_a_category(): void
    {
        $categoria = Categoria::factory()->create();
        $producto = Producto::factory()->create(['categoria_id' => $categoria->id]);

        $this->assertInstanceOf(Categoria::class, $producto->categoria);
        $this->assertEquals($categoria->id, $producto->categoria->id);
    }

    public function test_product_attributes(): void
    {
        $producto = Producto::factory()->create([
            'nombre' => 'Laptop Gamer',
            'precio' => 1200.50,
            'stock' => 5
        ]);

        $this->assertEquals('Laptop Gamer', $producto->nombre);
        $this->assertEquals(1200.50, $producto->precio);
        $this->assertEquals(5, $producto->stock);
    }
}
