<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AboutTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_add_about(): void
    {
        $response = $this->post('/', [
            'identifier' => generate_identifier(),
            'name' => 'About 2',
            'description' => 'Dubois Safaris is a renowned safari tours and travel company that provides exclusive and intimate safaris ranging from Luxury, Mid-range and Budget across world’s famous safari countries, Kenya, Tanzania, Uganda and Rwanda since 2009. Whether you are looking for a private, family, group, corporate or special interest safari our professional team is always ready to give an authentic and memorable African experience.',
            'mission' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim debitis laboriosam eum possimus illo consectetur ad esse dolorum atque ex?',
            'vision' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim debitis laboriosam eum possimus illo consectetur ad esse dolorum atque ex?',
            'core_values' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.',
            'added_by' => 1,
        ]);

        $response->assertStatus(200);
    }
}
