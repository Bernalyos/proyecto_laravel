<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->withPersonalTeam()->create();
    }

    public function test_can_see_category_index(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('categoria.index'));

        $response->assertStatus(200);
    }

    public function test_can_create_category(): void
    {
        $data = [
            'nombre' => 'Nueva Categoría',
            'descripcion' => 'Descripción de prueba',
        ];

        $response = $this->actingAs($this->user)
            ->post(route('categoria.store'), $data);

        $response->assertRedirect(route('categoria.index'));
        $this->assertDatabaseHas('categorias', [
            'nombre' => 'Nueva Categoría',
        ]);
    }

    public function test_can_edit_category(): void
    {
        $categoria = Categoria::factory()->create();
        
        $data = [
            'nombre' => 'Categoría Editada',
            'descripcion' => 'Descripción editada',
        ];

        $response = $this->actingAs($this->user)
            ->put(route('categoria.update', $categoria->id), $data);

        $response->assertRedirect(route('categoria.index'));
        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
            'nombre' => 'Categoría Editada',
        ]);
    }

    public function test_can_delete_category(): void
    {
        $categoria = Categoria::factory()->create();

        $response = $this->actingAs($this->user)
            ->delete(route('categoria.destroy', $categoria->id));

        $response->assertRedirect(route('categoria.index'));
        $this->assertDatabaseMissing('categorias', [
            'id' => $categoria->id,
        ]);
    }
}
