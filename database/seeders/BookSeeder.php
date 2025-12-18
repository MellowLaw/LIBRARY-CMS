<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'isbn' => '978-0061120084',
                'description' => 'A gripping tale of racial injustice and childhood innocence in the Deep South.',
                'category' => 'Fiction',
                'total_copies' => 3,
                'available_copies' => 2,
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'isbn' => '978-0062316110',
                'description' => 'An exploration of the history and impact of Homo sapiens on the world.',
                'category' => 'History',
                'total_copies' => 5,
                'available_copies' => 5,
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '978-0132350884',
                'description' => 'A guide to writing better, more maintainable code.',
                'category' => 'Technology',
                'total_copies' => 4,
                'available_copies' => 3,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'isbn' => '978-0451524935',
                'description' => 'A dystopian social science fiction novel and cautionary tale.',
                'category' => 'Fiction',
                'total_copies' => 6,
                'available_copies' => 4,
            ],
            [
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'isbn' => '978-0307887894',
                'description' => 'How constant innovation creates radically successful businesses.',
                'category' => 'Business',
                'total_copies' => 2,
                'available_copies' => 1,
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'isbn' => '978-0735211292',
                'description' => 'An easy and proven way to build good habits and break bad ones.',
                'category' => 'Self-Help',
                'total_copies' => 4,
                'available_copies' => 0,
            ],
            [
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'isbn' => '978-0553380163',
                'description' => 'A landmark volume in science writing by one of the great minds of our time.',
                'category' => 'Science',
                'total_copies' => 3,
                'available_copies' => 3,
            ],
            [
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'isbn' => '978-1451648539',
                'description' => 'The exclusive biography of Steve Jobs.',
                'category' => 'Biography',
                'total_copies' => 2,
                'available_copies' => 2,
            ],
        ];

        foreach ($books as $bookData) {
            $categoryName = $bookData['category'];
            unset($bookData['category']);

            $category = Category::where('slug', \Str::slug($categoryName))->first();

            if ($category) {
                Book::create(array_merge($bookData, [
                    'category_id' => $category->id,
                    'is_published' => true,
                ]));
            }
        }
    }
}
