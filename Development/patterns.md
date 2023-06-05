# Design Patterns

## Tutorials

- https://www.journaldev.com/31902/gangs-of-four-gof-design-patterns
- https://tuxdoc.com/download/gang-of-four-design-patterns-40pdf_pdf
- https://www.tutorialspoint.com/design_pattern/index.htm
- https://sourcemaking.com/design_patterns
- https://refactoring.guru/design-patterns/catalog
- https://www.youtube.com/playlist?list=PLlsmxlJgn1HJpa28yHzkBmUY-Ty71ZUGc

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

```java
Vehicle tank = new Tank();
tank.drive();

Vehicle robotAdapter = new RobotAdapter();
robotAdapter.drive();
```

### Bridge

If you have a requirement like this:

|        |   Forward Button   |    Back Button    |
|--------|--------------------|-------------------|
| TV     | Increment channel  | Decrement channel |
| Player | Fast Forward       | Rewind            |

Then if later, there are more types of TVs and more buttons to implement for (ie: the varieties expands in 2 dimentions), then how will we handle it?

![](/Illustrations/Patterns/bridge.png)

Doing it like a inheritance-tree will become unwieldy very fast.   
It's better to do it in a composition manner.  

```java
public abstract class TV // This is the abstraction
{
    protected Button button; // This reference to the implementation is called the bridge

    protected TV(Button button)
    {
        this.button = button;
    }

    abstract void otherMethods();
}
```

- The client works with the abstraction.
- But it's still client's job to link the abstraction object to one of the implementation objects.

### Decorator

Situation: Burger shop sells different types of burger, with many different combinations of ingredients.

Doing this via the **inheritence** way is too rigid and clumsy:

`class Bun {}`

`class Hamburger extends Bun ()`

`class Cheeseburger extends Hamburger ()`

Doing this in a **composition** manner is more flexible:

So a cheeseburger can be made by: `new Cheese( new Patty( new Bun() ) )`

```java
abstract class Burger 
{

}

class Bun extends Burger 
{

}

abstract class Ingredient extends Burger // This is the decorator
{
    private Burger burger;

    public Ingredient(Burger burger)
    {
        this.burger = burger;
    }
}
class Patty extends Ingredient 
{
    public Patty(Burger burger)
    {
        super(burger);
    }
}
class Cheese extends Ingredient 
{
    public Cheese(Burger burger)
    {
        super(burger);
    }
}
```

Note: A un-made plain-bun burger is interacted with in the same way as a finished burger with multiple ingredients.

### Composite 

Using the composite pattern often leads to the using of decorator pattern.  
All elements (nodes & leaves, or eg: book & volume) have the same interface, so they can be interacted with in the same way.  

![](/Illustrations/Patterns/composition.png)

In this example, both Volume and Book extends the Node class.  
Then you can interact with Book and Volume in the same way:  
```java
Node myVolume = new Volume();
myVolume.add(new Volume);
myVolume.add(new Book);
```

### Facade

Creating a wrapper interfaces on top of existing interfaces to help client applications.

### Proxy

A simpler class acting as a proxy in front of a more complicated class. Client interact with the proxy class.

### Flyweight

Caching and reusing objects, when there is a need to create objects that varies little. Saves RAM. 
```java
class Factory 
{
    private static HashMap cache = new HashMap();

    public static Vehicle getVehicle(String type)
    {
        Vehicle vehicle = null;

        if (cache.containsKey(type)) // THE IMPORTANT PART
        {
            vehicle = cache.get(type);
        }

        // Instantiate the vehicle object

        return vehicle;
    }
}
```

Then you can:
```java
Vehicle car = Factory.getVehicle('car'); // If a car was previous made by the factory, then a cached car would be returned.
car.assignColor('blue'); // Make minor changes when necessary
```

## Behavioural patterns

### Template

When algorithms are roughly the same. 

Eg: parsers/processors of different file formats - the reading part, the data re-organizing part, etc... are all the same. The only bit of difference is the parsing of different file formats.

![](/Illustrations/Patterns/template.png)

Then you can: `fileAnalyzer.analyze()`

### Chain of responsibility

Request is passed to a sequential chain of handlers.

![](/Illustrations/Patterns/chain.png)

### Command

When a command (which is normally a function) is made into an object.

- It can be called later.
- It become undo-able.
- The command can be called from many different places.

```java
interface Command 
{
    // ...
}

class DemoCommand implements Command 
{
    public function execute()
    {

    }
}
```

Then you can: `demoCommand.execute()`

### Interpreter

Like the parsing of programming languages.

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

Observed
```php
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
```

Observer
```php
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

The following code shows how a product's tax can be can be calculated for different situations (eg in different countries)

|   |Tax in situation 1|Tax in situation 2| ... |
|---|---|---|---|
|Product1| xxx | yyy | zzz |

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

The following code shows how many products can have different taxes calculated for them

|   |Tax in situation 1|Tax in situation 2| ... |
|---|---|---|---|
|Product1| ... | ... | ... |
|Product2| ... | ... | ... |
| ... | ... | ... | ... |

```php
// This is the visitor
class ProductTax implements TaxInterface
{
    // calculate(ProductInterface $product) can be called from the client
    // Eg: in the client, there can be a loop, looping thru all the products, and invoking the calculation of taxes for them
    public function calculate(ProductInterface $product) : float
    { // The calculation of products' taxes starts here (from the visitor)
        return ($product->price() * 1.20);
    }
}

class Product implements ProductInterface
{
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