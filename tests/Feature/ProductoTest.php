<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->withPersonalTeam()->create();
    }

    public function test_can_see_product_index(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('producto.index'));

        $response->assertStatus(200);
    }

    public function test_can_create_product(): void
    {
        $categoria = Categoria::factory()->create();
        
        $data = [
            'nombre' => 'Producto de Prueba',
            'precio' => 99.99,
            'stock' => 10,
            'categoria_id' => $categoria->id,
        ];

        $response = $this->actingAs($this->user)
            ->post(route('producto.store'), $data);

        $response->assertRedirect(route('producto.index'));
        $this->assertDatabaseHas('productos', [
            'nombre' => 'Producto de Prueba',
            'precio' => 99.99,
        ]);
    }

    public function test_can_show_product(): void
    {
        $producto = Producto::factory()->create();

        $response = $this->actingAs($this->user)
            ->get(route('producto.show', $producto->id));

        $response->assertStatus(200);
        $response->assertSee($producto->nombre);
    }

    public function test_can_edit_product(): void
    {
        $producto = Producto::factory()->create();
        
        $data = [
            'nombre' => 'Producto Editado',
            'precio' => 150.00,
            'stock' => 5,
            'categoria_id' => $producto->categoria_id,
        ];

        $response = $this->actingAs($this->user)
            ->put(route('producto.update', $producto->id), $data);

        $response->assertRedirect(route('producto.index'));
        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
            'nombre' => 'Producto Editado',
        ]);
    }

    public function test_can_delete_product(): void
    {
        $producto = Producto::factory()->create();

        $response = $this->actingAs($this->user)
            ->delete(route('producto.destroy', $producto->id));

        $response->assertRedirect(route('producto.index'));
        $this->assertDatabaseMissing('productos', [
            'id' => $producto->id,
        ]);
    }
}
