<?php

/**
 * (c) Javier Neyra
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gi\Resource;

use Gi\Resource\Exception\ResourceException;

/**
 * @author Javier Neyra
 */
class Resource implements \IteratorAggregate, ResourceInterface
{
   /**
    * The parent of this Resource
    * 
    * @var FormInterface
    */
    private $parent;
    
    /**
     * The children of this resource
     * 
     * @var array An array of FormInterface instances
     */
    private $children = array();
    
    /**
     * resource's name
     * 
     * @var string
     */
    private $name = '';

    public function getIterator()
    {
        return new \ArrayIterator($this->children);
    }

    public function add(ResourceInterface $child)
    {
        $child->setParent($this);

        $this->children[$child->getName()] = $child;

        return $this;
    }

    public function all()
    {
        return $this->children;
    }

    public function count()
    {
        return count($this->children);
    }

    public function get($name)
    {
         if (isset($this->children[$name])) {
            return $this->children[$name];
        }

        throw new \InvalidArgumentException(sprintf('Child "%s" does not exist.', $name));
    }

    public function getName()
    {
        return $this->name;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getRoot()
    {
        return $this->isRoot() ? $this : $this->parent->getRoot();
    }

    public function has($name)
    {
        return isset($this->children[$name]);
    }

    public function hasParent()
    {
        return null !== $this->parent;
    }

    public function isRoot()
    {
        return !$this->hasParent();
    }

    public function offsetExists($name)
    {
        return $this->has($name);
    }

    public function offsetGet($name)
    {
        return $this->get($name);        
    }

    public function offsetSet($child, $value)
    {
        $this->add($child);
    }

    public function offsetUnset($name)
    {
        $this->remove($name);
    }

    public function remove($name)
    {
        if ($this->has($name)) {
            $this->children[$name]->setParent(null);
            unset($this->children[$name]);
        }

        return $this;
    }

    public function setParent(ResourceInterface $parent = null)
    {
        if ('' === $this->getName()) {
            throw new ResourceException('A resource with an empty name cannot have a parent resource.');
        }

        $this->parent = $parent;

        return $this;
    }
}