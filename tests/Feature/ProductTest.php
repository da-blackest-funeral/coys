<?php

    namespace Tests\Feature;

    use App\Models\Product;
    use App\Models\User;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Tests\TestCase;
    use Throwable;

    class ProductTest extends TestCase
    {
        use RefreshDatabase, WithFaker;

        public function test_user_can_add_products_to_card(): void {
            $this->withoutExceptionHandling();
            $this->seed();

            $this->actingAs($user = User::factory()->create());

            $this->post(route('products.store'), [
                'clothe_id' => 1,
                'size' => 'XXL',
            ])->assertStatus(200);

            $this->assertDatabaseHas('products', [
                'user_id' => $user->id,
                'clothe_id' => 1,
                'size' => 'XXL',
            ]);
        }

        /**
         * @throws Throwable
         */
        public function test_user_can_see_his_card() {
            $this->withoutExceptionHandling();
            $this->seed();
            $this->actingAs(User::first());

            Product::factory()->create();
            self::assertNotEmpty(
                $this->get(route('products.index'))
                    ->decodeResponseJson()
                    ->json()
            );
        }

        public function test_user_can_delete_his_products() {
            $this->withoutExceptionHandling();
            $this->seed();
            $this->actingAs(User::first());

            $size = 'XL';
            $id = Product::create([
                'user_id' => 1,
                'clothe_id' => 10,
                'size' => $size,
            ])->id;

            $this->post(route('products.destroy', ['product' => $id]), [
                '_method' => 'delete',
            ])->assertStatus(204);

            $this->assertDatabaseMissing('products', compact('id', 'size'));
        }

        public function test_user_can_not_delete_other_people_goods() {
            $this->withoutExceptionHandling();
            $this->seed();
            $this->actingAs(User::first());

            $id = Product::create([
                'user_id' => 5,
                'clothe_id' => 10,
                'size' => 'L',
            ])->id;

            $this->post(route('products.destroy', ['product' => $id]), [
                '_method' => 'delete',
            ])->assertStatus(403);
        }

        public function test_admin_user_can_not_store_clothes() {
            $this->withoutExceptionHandling();
            $this->seed();

            \DB::table('users')
                ->where('id', 1)
                ->update([
                    'is_admin' => true,
                ]);

            $this->actingAs(User::first());
            $this->setUpFaker();
            $link = $this->faker->imageUrl;
            $this->post(route('clothes.store'), [
                'color' => $this->faker->colorName(),
                'img' => $link,
                'price' => $this->faker->numerify('####'),
            ]);

            $this->assertDatabaseHas('clothes', [
                'img' => $link,
            ]);
        }

        public function test_no_admin_can_not_add_clothes() {
            $this->seed();

            $this->actingAs(User::first());
            $this->setUpFaker();
            $link = $this->faker->imageUrl;

            $this->post(route('clothes.store'), [
                'color' => $this->faker->colorName(),
                'img' => $link,
                'price' => $this->faker->numerify('####'),
            ])->assertForbidden();
        }
    }
