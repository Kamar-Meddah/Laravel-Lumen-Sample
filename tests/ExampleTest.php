<?php

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testExample()
    {
        $this->call('post', '/Api/comments/post', ['post_id' => 1, 'content' => 'balbla']);
        $this->assertResponseStatus(401);

    }

    public function testNonExistedRouter()
    {
        $this->call('post', '/Api/comment/post', ['post_id' => 1, 'content' => 'balbla']);
        $this->assertResponseStatus(404);

    }
}
