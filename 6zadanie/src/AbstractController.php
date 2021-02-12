<?php

namespace Src;

abstract class AbstractController
{

    protected $currentUser = '';
    protected $view;

    protected function redirect($url)
    {
        throw new RedirectException($url);
    }

    /**
     * @param mixed $view
     */
    public function setView($view): void
    {
        $this->view = $view;
    }

    public function setCurrentUser($currentUser): void
    {
        $this->currentUser = $currentUser;
    }


}