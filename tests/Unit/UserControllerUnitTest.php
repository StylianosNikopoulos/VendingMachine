<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserControllerUnitTest extends TestCase
{
    use RefreshDatabase;
    protected $controller;

    //Parent functions
    protected function setUp(): void{
        parent::setUp();
        $this->controller = new UserController(); 
        $this->artisan('migrate');
    }

    protected function createSeller(): User{
        $seller = User::factory()->create([
            'role' => 'seller',  
        ]);
        return $seller;
    }

    protected function createBuyer(): User{
        $buyer = User::factory()->create([
            'role' => 'buyer',  
        ]);
        return $buyer;
    }

    protected function createProduct(): Product{
        $product = Product::factory()->create([
            'sellerId' => $this->createSeller()->id,  
        ]);
        return $product;
    }


    //Test calculateChange function if calculation is correct
    public function testCalculateChange(){
        $this->assertEquals([100, 50], $this->controller->calculateChange(150));
        $this->assertEquals([], $this->controller->calculateChange(0));
        $this->assertEquals([5], $this->controller->calculateChange(5));
        $this->assertEquals([100, 100, 5], $this->controller->calculateChange(205));
        $this->assertEquals([50, 5], $this->controller->calculateChange(55));
    }


    //Test about index function
    public function test_unauthenticated_user_see_myproducts(){
        $response = $this->get('/my-products');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_authenticated_buyer_see_myproducts(){
        $buyer = $this->createBuyer();

        $response = $this->actingAs($buyer)->get('/my-products');
        $response->assertStatus(403);
    }

    public function test_authenticated_seller_see_myproducts(){
        $seller = $this->createSeller();

        $response = $this->actingAs($seller)->get('/my-products');
        $response->assertStatus(200);
    }


    //Test about deposit function
    public function test_unauthenticated_user_cannot_deposit(){
        $response = $this->post('/deposit', ['amount' => 10]);

        $response->assertStatus(302);  
        $response->assertRedirect('/login'); 
    }
    
    //Test buy function if unauthenticated user is can buy product
    public function test_unauthenticated_user_cannot_buy()
    {
        // Δημιουργία χρήστη (seller) με ρόλο "seller"
        $seller = User::factory()->create([
            'role' => 'seller',  
        ]);
    
        $product = Product::factory()->create([
            'cost' => 100, 
            'amountAvailable' => 10,  
            'productName' => 'A Product',
            'sellerId' => $seller->id,  
        ]);
    }


    //Some more testing
    public function test_login_redirects_to_dashboard(){
        $response = $this->post('/login',[
            'email' => $this->createSeller()->email,
            'password' => 'password',
        ]);
        $response = $this->get('/dashboard');
        $response->assertStatus(200);

    }

    public function test_api_returns_products(){
        $product = $this->createProduct();
        $response = $this->getJson('/api/products');
        $response->assertJson([$product->toArray()]);
    }

    public function test_seller_can_see_myproducts_button(){
        $response = $this->actingAs($this->createSeller())->get('/');
        $response->assertStatus(200);
        $response->assertSee('My Products');
    }

    public function test_buyer_cannot_see_myproducts_button(){
        $response = $this->actingAs($this->createBuyer())->get('/');
        $response->assertStatus(200);
        $response->assertDontSee('My Products');
    }
}




