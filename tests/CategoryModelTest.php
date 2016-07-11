<?php

use App\Category;
use App\Lesson;
use Illuminate\Support\Facades\Auth;

class CategoryModelTest extends TestCase
{
    public function testRelationshipWithLessons()
    {
        Auth::loginUsingId(1);
        $cat = Category::find(1);

        $words = factory(App\Lesson::class, 2)->create([
            'name' => 'lesson_a',
            'user_id' => Auth::id(),
            'category_id' => $cat->id,
            'result' => 1
        ]);

        foreach ($words as $lesson) {
            $this->assertEquals($lesson->category_id, $lesson->category->id);
        }
    }

    public function testRelationshipWithWords()
    {
        $cat = Category::find(1);

        $words = factory(App\Word::class, 2)->create([
            'content' => 'English',
            'lesson_id' => 1,
            'category_id' => $cat->id
        ]);

        foreach ($words as $word) {
            $this->assertEquals($word->category_id, $word->category->id);
        }
    }

    public function testCreateCategory()
    {
        $cate = Category::create([
            'name' => 'name',
            'description' => 'description'
        ]);

        $this->assertEquals('name', $cate->name);
        $this->assertNotEmpty($cate);
        $this->assertEquals('description', $cate->description);
    }

    public function testValidateIDFail()
    {
        $data = ['id' => 'test'];
        $validate = Category::validateParams($data, Category::$rules);

        $this->assertFalse($validate);
    }

    public function testValidateIDSuccess()
    {
        $data = ['id' => 1];
        $validate = Category::validateParams($data, Category::$rules);

        $this->assertTrue($validate);
    }

    public function testCanDeleteCategory()
    {
        $cate = factory('App\Category')->create();
        $catID = $cate->id;

        $this->assertTrue($cate->delete());
        $this->assertNull(Category::find($catID));
    }

    public function testCanUpdateCategory()
    {
        $cate = Category::find(1);
        $nameBeforeUpdate = $cate->name;

        $cate->name = 'update';

        $this->assertTrue($cate->save());
        $this->assertEquals('update', $cate->name);
        $this->assertTrue($nameBeforeUpdate != $cate->name);
    }
}
