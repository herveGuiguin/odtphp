<?php

namespace Odtphp;

use RecursiveIterator;

/**
 * Segments iterator
 * You need PHP 5.2 at least
 * You need Zip Extension or PclZip library
 * Encoding : ISO-8859-1
 * Author: neveldo
 * Modified by: Loïc HENRY - https://loicyeu.fr
 * Date: 2021-05-06 15:22:54
 * SVN Revision: 42
 * Id: SegmentIterator.php 42 2009-06-17 09:11:57Z neveldo
 *
 * @property int[]|string[] keys
 * @copyright  GPL License 2008 - Julien Pauli - Cyril PIERRE de GEYER - Anaska (http://www.anaska.com)
 * @license    http://www.gnu.org/copyleft/gpl.html  GPL License
 * @version    1.8
 */
class SegmentIterator implements RecursiveIterator {
    private $ref;
    private $key;

    public function __construct(array $ref) {
        $this->ref = $ref;
        $this->key = 0;
        $this->keys = array_keys($this->ref);
    }

    public function hasChildren() {
        return $this->valid() && $this->current() instanceof Segment;
    }

    public function valid() {
        return array_key_exists($this->key, $this->keys);
    }

    public function current() {
        return $this->ref[$this->keys[$this->key]];
    }

    public function getChildren() {
        return new self($this->current()->children);
    }

    public function key() {
        return $this->key;
    }

    public function rewind() {
        $this->key = 0;
    }

    public function next() {
        $this->key++;
    }
}
