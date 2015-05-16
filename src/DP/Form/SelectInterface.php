<?php

namespace DP\Form;

interface SelectInterface
{
    function setValueOptions(array $options);
    
    function setSelected($selected);
}
