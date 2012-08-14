<?php

/**
 * (c) Javier Neyra
 *
 * For the full copyright and license inresourceation, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gi\Resource;

/**
 * @author Javier Neyra
 */
interface ResourceInterface extends \ArrayAccess, \Traversable, \Countable
{

    /**
     * Sets the parent Resource.
     *
     * @param ResourceInterface $parent The parent resource
     *
     * @return ResourceInterface The resource instance
     */
    public function setParent(ResourceInterface $parent = null);

    /**
     * Returns the parent resource.
     *
     * @return ResourceInterface The parent resource
     */
    public function getParent();

    /**
     * Returns whether the resource has a parent.
     *
     * @return Boolean
     */
    public function hasParent();

    /**
     * Adds a child to the resource.
     *
     * @param ResourceInterface $child The ResourceInterface to add as a child
     *
     * @return ResourceInterface The resource instance
     */
    public function add(ResourceInterface $child);

    /**
     * Returns the child with the given name.
     *
     * @param string $name The name of the child
     *
     * @return ResourceInterface The child resource
     */
    public function get($name);

    /**
     * Returns whether a child with the given name exists.
     *
     * @param string $name The name of the child
     *
     * @return Boolean
     */
    public function has($name);

    /**
     * Removes a child from the resource.
     *
     * @param string $name The name of the child to remove
     *
     * @return ResourceInterface The resource instance
     */
    public function remove($name);

    /**
     * Returns all children in this group.
     *
     * @return array An array of ResourceInterface instances
     */
    public function all();
    
    /**
     * Returns the name by which the resource is identified in resources.
     *
     * @return string The name of the resource.
     */
    public function getName();

    /**
     * Returns the root of the resource tree.
     *
     * @return ResourceInterface The root of the tree
     */
    public function getRoot();

    /**
     * Returns whether the field is the root of the resource tree.
     *
     * @return Boolean
     */
    public function isRoot();
}