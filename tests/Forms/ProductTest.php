<?php
namespace UiBuilder\Form\Tests\Forms;

use Livewire\Livewire;
use UiBuilder\Form\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use UiBuilder\Form\Tests\Stubs\Product;
use UiBuilder\Form\Tests\Stubs\ProductForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use GetThingsDone\Attributes\Builders\SchemaBuilder;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        SchemaBuilder::make( new Product )->createTable();
        if (!file_exists('../../vendor/orchestra/testbench-core/laravel/app/Http/Livewire')) {
            mkdir('../../vendor/orchestra/testbench-core/laravel/app/Http/Livewire', 0777, true);
        }
    }

    /**
     * @test
     */
    public function mount()
    {
        $product = Product::create([
            'code' => 'productcode',
            'name' => 'Product Name',
            'size' => 'Size XL'
        ]);

        Livewire::test(ProductForm::class, [ 'model' => $product] )
            ->assertSet('defaultValues.id',1)
            ->assertSet('defaultValues.code','productcode')
            ->assertSet('defaultValues.name','Product Name')
            ->assertSet('defaultValues.size','Size XL')
            ->assertSet('values.id',1)
            ->assertSet('values.code','productcode')
            ->assertSet('values.name','Product Name')
            ->assertSet('values.size','Size XL');
    }

    /**
     * @test
     */
    public function create()
    {
        Livewire::test(ProductForm::class, [ 'model' => new Product])
            ->call('create')
            ->assertSee("values.code")
            ->assertSee("values.name")
            ->assertSee("values.size")
            ->assertSee("text");
    }

    /** 
     * @test 
     */
    public function validate()
    {
        Livewire::test(ProductForm::class, [ 'model' => new Product] )
            ->set('values',[
                'code' => '',
                'name' => '',
            ])
            ->call('save')
            ->assertHasErrors([
                'values.code' => 'required',
                'values.name' => 'required',
            ])
            ->assertHasNoErrors([
                'values.size' => 'required'
            ]);
    }

    /** @test */
    public function store()
    {
        Livewire::test(ProductForm::class, [ 'model' => new Product] )
            ->set('values',[
                'code' => 'productcode',
                'name' => 'Product Name', 
                'size' => 'Size XL'
            ])->call('save');
    
        $this->assertDatabaseHas('products',[
            'code' => 'productcode',
            'name' => 'Product Name',
            'size' => 'Size XL'
        ]);
    }

    /** @test */
    public function edit(){

        $product = Product::create([
            'code' => 'productcode',
            'name' => 'Product Name',
            'size' => 'Size XL'
        ]);

        Livewire::test(ProductForm::class, [ 'model' => new Product] )
            ->call('edit',1)
            ->assertSet('values.id',1)
            ->assertSet('values.code','productcode')
            ->assertSet('values.name','Product Name')
            ->assertSet('values.size','Size XL');
    }

    /** @test */
    public function update()
    {
        Product::create([
            'code' => 'productcode',
            'name' => 'Product Name',
            'size' => 'Size XL'
        ]);

        Livewire::test(ProductForm::class, [ 'model' => new Product] )
            ->set('values',[
                'id' => 1,
                'code' => 'productcode',
                'name' => 'Product Name Updated',
                'size' => 'Size XXL'
            ])->call('save');

        $this->assertDatabaseHas('products',[
            'id' => 1,
            'code' => 'productcode',
            'name' => 'Product Name Updated',
            'size' => 'Size XXL'
        ]);
    }

    /** @test */
    public function destroy()
    {
        Product::create([
            'code' => 'productcode',
            'name' => 'Product Name',
            'size' => 'Size XL'
        ]);

        Livewire::test(ProductForm::class, [ 'model' => new Product] )
            ->call('destroy',1);

        $this->assertSoftDeleted('products',[
            'code' => 'productcode',
            'name' => 'Product Name',
            'size' => 'Size XL'
        ]);
    }
}