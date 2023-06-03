# Design Patterns

## Tutorials

- https://www.journaldev.com/31902/gangs-of-four-gof-design-patterns
- https://tuxdoc.com/download/gang-of-four-design-patterns-40pdf_pdf
- https://www.tutorialspoint.com/design_pattern/index.htm
- https://sourcemaking.com/design_patterns
- https://refactoring.guru/design-patterns/catalog
- https://www.youtube.com/playlist?list=PLzS3AYzXBoj8t5hPykr5VU7jG-kEim-LX
- https://www.youtube.com/watch?v=JFvSCobD7JU
- https://www.youtube.com/watch?v=tv-_1er1mWI

## Creational patterns

### Factory 

The factory pattern takes out the responsibility of instantiating a object from the client class to a Factory class.

![](/Illustrations/Patterns/factory.png)

### Abstract Factory 

But if we have get a new requirement, that both van and car can have 2 varieties.  
Then the standard factory pattern can NOT nicely accomodate this "2D-ness".  

|       |    Van    |    Car    |
|-------|-----------|-----------|
| Big   |  Big Van  |  Big Car  |
| Small | Small Van | Small Car |

![](/Illustrations/Patterns/abstract_factory.png)

### Prototype

Creating a new object instance from another similar instance and then modify according to our requirements.

### Builder

Creating an object step by step and a method to finally get the object instance.

The Builder class  
```php
class CarBuilder
{
    protected $wheels = 4;
    protected $fuel = 100.0;
    protected $engine = null;

    public function wheels(int $wheels): self
    {
        $this->wheels = $wheels;

        return $this;
    }
    public function fuel(float $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }
    public function engine(Engine $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    public function build(): CarInterface
    {
        return new CarInstance(
            $this->engine,
            $this->wheels,
            $this->fuel
        );
    }
}
```

The client class  
```php
// Build car with defaults.
$builder = new CarBuilder();
$car = $builder->build();

// Build car with different fuel quantity.
$builder = new CarBuilder();
$car = $builder->fuel(999)->build();

// Build car with different wheel quantity.
$builder = new CarBuilder();
$car = $builder->wheels(3)->build();

// Build FULL car.
$builder = new CarBuilder();
$car = $builder
        ->fuel(999)
        ->wheels(3)
        ->engine(
            new Engine()
        )
        ->build();
```

Also notice that the Builder always returns itself, which allows the builder methods to be "chained up".   
Laravel Eloquent's ORM is an example of this ( recall: `DB::table('table_name')->select(...)->where(...)->get() ...` )  

### Singleton

Only one instance of the class can be created.

Here is simplist example

```java
public class ClassName
{
    private static final ClassName instance = new ClassName();

    private ClassName()
    {
        // private constructor
    }
    public static ClassName getInstance()
    {
        return instance;
    }
}
```

There are also eager and lazy types.  

Concurrency can obviously cause problems. In Java, it can be solved by using the `synchronized` keyword.   
https://www.geeksforgeeks.org/java-singleton-design-pattern-practices-examples/   

Note: `synchronized` is normally applied to methods, so that a critical section of code won't get into a race condition. `volatile` is normally applied to concurrency-affected variables, so that upon their update, their new value is written directly into main memory, instead of the process's CPU cache.  

It can cause problems for testing too:  
- https://medium0.com/@fatihcyln/the-problems-with-singletons-and-why-you-should-use-di-instead-5a0fa0a5baed
- https://stackoverflow.com/questions/10936695/how-to-test-singleton-class-that-has-a-static-dependency/10939204#10939204
- https://enterprisecraftsmanship.com/posts/singleton-vs-dependency-injection/

More reading:  
https://7php.com/how-to-code-a-singleton-design-pattern-in-php-5/

## Structural patterns

### Adapter

Provides an interface between two unrelated entities so that they can work together.

![](/Illustrations/Patterns/adaptor.png)

### Bridge

![](/Illustrations/Patterns/bridge0.JPG)

![](/Illustrations/Patterns/bridge.png)

### Decorator

**Modify/add functionality to an object at runtime.**

![](/Illustrations/Patterns/decorator.png)

This type of composition is **better than inheritance. With inheritance, if top class changes, everything below needs to be refactored.**

The decorator pattern allows an entity to completely contain another entity so that using the decorator looks identical to the contained entity. This allows the decorator to **modify the behaviour and/or content of whatever it is encapsulating without changing the outward appearance of the entity**. For example, you might use a decorator to add logging output on the usage of the contained element without changing any behaviour of the contained element. 

### Composite 

Handle individual objects and composites uniformly. Eg handle a book and a collection of books the same way.

![](/Illustrations/Patterns/composite.png)

Decorator & Composite usually go hand in and hand. In that using the composite pattern often leads to also using the decorator pattern.

The composite pattern allows you to build a hierarchical structure (such as a tree of elements) in a way that allows your external code to view the entire structure as a single entity. So the interface to a leaf entity is exactly the same as the entity for a compound entity. So the essence is that all elements in your composite structure have the same interface even though some are leaf nodes and others are entire structures. User interfaces often use this approach to allow easy composability. 

### Facade

Creating a wrapper interfaces on top of existing interfaces to help client applications.

### Proxy

### Flyweight

Caching and reusing object instances, when there is a need to create objects that varies little.

![](/Illustrations/Patterns/flyweight1.png)

![](/Illustrations/Patterns/flyweight2.png)

![](/Illustrations/Patterns/flyweight3.png)

## Behavioural patterns

### Template method

When algorithms are roughly the same. 

Eg: parsers/processors of different file formats - the reading part, the data re-organizing part, etc... are all the same. The only bit of difference is the parsing of different file formats.

![](/Illustrations/Patterns/template.png)

### Chain of responsibility

Request is passed to a sequential chain of handlers.

![](/Illustrations/Patterns/chain_responsibility.png)

### Command

When a command (which is normally a function) is made into an object.

- It can be called later.
- It become undo-able.
- The command can be called from many different places.

![](/Illustrations/Patterns/command1.png)

![](/Illustrations/Patterns/command2.png)

https://sourcemaking.com/design_patterns/command

### Interpreter

### Iterator

Access the elements of an aggregate object sequentially without exposing its underlying representation.

- https://www.tutorialspoint.com/design_pattern/iterator_pattern.htm
- https://sourcemaking.com/design_patterns/iterator/php

### Mediator

Provide a centralized communication medium between different objects in a system.

### Memento

Used to save a history of an object's past states.

https://sourcemaking.com/design_patterns/memento/php

### Observer

Useful when you are interested in the state of an object and want to get notified whenever there is any change.

![](/Illustrations/Patterns/observer.png)

```php
// Observed
class Subject
{
    private $observer;

    function __construct(Observer $observer) 
    {
      $this->observer = $observer;
    }

    function notify() 
    {
      $this->observer->update($this);
    }

    function updateFavorites() 
    {
      $this->notify();
    }

    function getFavorites() 
    {
      return "Dummy Update Notice";
    }
}

// Observer
class Observer
{
    public function update(Subject $subject)
    {
      echo $subject->getFavorites() . "<br>";
    }
}

// Run
require_once("observer.php");
require_once("subject.php");

$gossipFan = new Observer();
$gossiper = new Subject($gossipFan);

$gossiper->updateFavorites();
$gossiper->updateFavorites();
```

### State

An object should change its behavior when its internal state changes. State-specific behavior should be defined independently.

### Strategy

Used when we have multiple algorithm for a specific task and client decides the actual implementation to be used at runtime.

```php
class ProductTax implements TaxInterface
{
    public function calculate(float $price) : float
    {
        return ($price * 1.20);
    }
}

class Product implements ProductInterface
{
    protected $tax = null;

    /**
     * Dependency Injection / Strategy Pattern
     */
    public function __construct(TaxInterface $tax): void
    {
        $this->tax = $tax;
    }

    public function calculatePrice(): float
    {
        return $this->tax->calculate($this->price());
    }
}
```

### Visitor

Perform an operation on a group of similar kind of Objects.

```php
class ProductTax implements TaxInterface
{
    public function calculate(ProductInterface $product) : float
    {
        return ($product->price() * 1.20);
    }
}

class Product implements ProductInterface
{
    /**
     * Visitor Pattern
     */
    public function calculatePrice(TaxInterface $tax): float
    {
        return $tax->calculate($this);
    }
}
```

Visitor vs Strategy: Visitor pattern allows **Double Dispatch**

- https://stackoverflow.com/questions/8665295/what-is-the-difference-between-strategy-pattern-and-visitor-pattern
- https://www.youtube.com/watch?v=TeZqKnC2gvA

---

# Others

## SOLID

![](https://raw.githubusercontent.com/Ruslan-Aliyev/Design-Patterns/master/Illustrations/Patterns/SOLID.jpg)

## Push vs Pull

## Repository

## Provider

---

# Microservices Patterns