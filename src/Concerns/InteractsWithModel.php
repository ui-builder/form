<?php
namespace UiBuilder\Form\Concerns;

use Illuminate\Support\Facades\Redirect;
use GetThingsDone\Attributes\Adapters\CacheAdapter;
use GetThingsDone\Attributes\Contracts\HasCastAttributes;

trait InteractsWithModel
{

    public ?string $modelCachedKey;

    protected function getCacheAdapter()
    {
        return app(CacheAdapter::class);
    }

    /**
     * Get the value of model
     */ 
    public function getModel()
    {
        return $this->getCacheAdapter()
                    ->setKey( $this->modelCachedKey )
                    ->getData() ?? Redirect::back();
    }

    /**
     * Set the value of model
     *
     * @return  self
     */ 
    public function setModel(HasCastAttributes $model)
    {
        $this->modelCachedKey = $this->getCacheAdapter()
                                    ->generateKey()
                                    ->setData( $model )
                                    ->getKey();

        return $this;
    }

    public function syncModel($id): self
    {   
        $model = $this->getModel()->firstWhere('id',$id);

        $this->setModel($model);

        return $this;
    }

    public function resetModel()
    {
        $classname = get_class( $this->getModel() );
        $model =  new $classname;
        $this->setModel($model);
    }
}