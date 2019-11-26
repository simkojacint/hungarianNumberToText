<?php

<?php

class HungarianNumberToText extends NumberFormatter
{
    protected $segments = [
        'billiárd',
        'billió',
        'milliárd',
        'millió',
        'ezer',
    ];
    
    public function __construct()
    {
        parent::__construct("hu", parent::SPELLOUT);
    }
    
    public function format($originalValue, $type = null)
    {
        $value = parent::format($originalValue, $type);
        
        if($originalValue < 2000) {
            return $value;
        }
        
        return str_replace(
            $this->segments,
            array_map(array($this, 'extendSegments'), $this->segments),
            $value
        );
    }
    
    protected function extendSegments(string $segment, string $haystack = '-')
    {
        return $segment . $haystack;
    }
}
