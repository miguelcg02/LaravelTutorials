<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['name'] - string - contains the product name
     * $this->attributes['price'] - int - contains the product price
     * $this->comments - Comment[] - contains the associated comments
     * $this->attributes['created_at'] - string - contains the product creation date
     * $this->attributes['updated_at'] - string - contains the product update date
     */

    protected $fillable = ['name', 'price'];

    public static function validateCreateform(Request $request): void
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|gt:100',
        ]);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName($name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice($price): void
    {
        $this->attributes['price'] = $price;
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function setComments(Collection $comments): void
    {
        $this->comments = $comments;
    }

    public function getCreated_At(): string
    {
        return $this->attributes['created_at'];
    }
    
    public function setCreated_At(string $created_at): void
    {
        $this->attributes['created_at'] = $created_at;
    }

    public function getUpdated_At(): string
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdated_At(string $updated_at): void
    {
        $this->attributes['updated_at'] = $updated_at;
    }

}
