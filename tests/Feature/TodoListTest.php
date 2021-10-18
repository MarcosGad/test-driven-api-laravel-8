<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\TodoList;


class TodoListTest extends TestCase
{

    use RefreshDatabase; //php artisan migrate

    private $list;

    public function setUp(): void
    {
        parent::setUp();
        $this->list = $this->createTodoList();
    }


    public function test_fetch_all_todo_list()
    {
        //$this->withoutExceptionHandling(); ---> replace with fun setUp in TestCase.php in file tests

        //preperation
        //TodoList::factory()->count(2)->create(); 

        //action
        $response = $this->getJson(route('todo-list.index'));

        //assertion
        $this->assertEquals(1, count($response->json()));
    }


    public function test_fetch_single_todo_list()
    {
        $response = $this->getJson(route('todo-list.show', $this->list->id));
        //dd($response->json()['name']);

        $response->assertOk();
    }


    public function test_store_new_todo_list()
    {
        $response = $this->postJson(route('todo-list.store'), ['name' => $this->list->name])
            ->assertCreated()
            ->json();

        $this->assertEquals($this->list->name, $response['name']);
        $this->assertDatabaseHas('todo_lists', ['name' => $this->list->name]);
    }


    public function test_while_storing_todo_list_name_field_is_required()
    {
        $this->withExceptionHandling();

        $this->postJson(route('todo-list.store'))
            ->assertUnprocessable() // == ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    
    public function test_delete_todo_list()
    {
        $this->deleteJson(route('todo-list.destroy', $this->list->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['name' => $this->list->name]);
    }


    public function test_update_todo_list()
    {
        $this->patchJson(route('todo-list.update', $this->list->id), ['name' => 'updated name'])
            ->assertOk();

        $this->assertDatabaseHas('todo_lists', ['id' => $this->list->id, 'name' => 'updated name']);
    }


    public function test_while_updating_todo_list_name_field_is_required()
    {
        $this->withExceptionHandling();

        $this->patchJson(route('todo-list.update', $this->list->id))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }



}
