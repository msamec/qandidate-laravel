<?php namespace Msamec\QandidateLaravel;

use Msamec\QandidateLaravel\Exceptions\QandidateException;
use Msamec\QandidateLaravel\Models\Toggle as DBToggle;
use Msamec\QandidateLaravel\Models\Condition as DBCondition;
use Qandidate\Toggle\Context;
use Qandidate\Toggle\OperatorCondition;
use Qandidate\Toggle\Toggle;
use Qandidate\Toggle\ToggleCollection\InMemoryCollection;
use Qandidate\Toggle\ToggleManager;

class Qandidate
{
    protected $manager, $toggle, $condition;

    public function __construct()
    {
        $this->manager = new ToggleManager(new InMemoryCollection());
    }

    public function active($featureName = null, $attributes = [])
    {
        if(!$featureName){
            throw new QandidateException(
                "Feature name must not be empty"
            );
        }

        if(!is_array($attributes)){
            throw new QandidateException(
                "Attribute must be an instance of array"
            );
        }

        $this->getToggleConditions($featureName);
        
        $conditionCollection = [];
        foreach($this->conditions as $condition){
            $class = $this->convertStringToClass($condition->operator);
            if('Qandidate\Toggle\Operator\InSet' === $class){
                $value = [$condition->value];
            }else{
                $value = $condition->value;
            }
            $operator = new $class($value);
            $conditionCollection[] = new OperatorCondition(
                $condition->key,
                $operator
            );
        }
        $toggle = new Toggle('toggling', $conditionCollection);
        $constName = $this->convertStringToConstant(
            $this->toggle->status
        );
        if('INACTIVE' === $constName){
            $toggle->deactivate();
        }else{
            $toggle->activate(constant('Qandidate\Toggle\Toggle::'.$constName));
        }
        $this->manager->add($toggle);
        $context = new Context();
        foreach($attributes as $key => $value){
            $context->set($key, $value);
        }

        return $this->manager->active('toggling', $context);
    }

    private function convertStringToClass($string)
    {
        $className = str_replace(
            "-",
            "",
            mb_convert_case($string, MB_CASE_TITLE)
        );
        return 'Qandidate\Toggle\Operator\\'.$className;
    }

    private function convertStringToConstant($string)
    {
        $constName = str_replace(
            "-",
            "_",
            mb_convert_case($string, MB_CASE_UPPER)
        );
        return $constName;
    }

    private function getToggleConditions($featureName)
    {
        $this->toggle = DBToggle::where('name', $featureName)->firstOrFail();
        $this->conditions = $this->toggle->conditions;
    }
}
