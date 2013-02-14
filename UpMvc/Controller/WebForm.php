<?php
/**
 * /UpMvc/Controller/WebForm.php
 * @package UpMvc2
 */

namespace UpMvc\Controller;

use UpMvc;

/**
 * Controller för exempelformulär
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Webform
{
    /**
     * Default action
     */
    public function index()
    {
        $c = UpMvc\Container::get();
        
        // Skapa ett webb-formulär
        $form = new UpMvc\Form('post', $c->site_path.'/UpMvc/WebForm/');
        $form->setId('myform');
        
        // Sätt upp formulärets fält
        $form->name      = new UpMvc\Form\Text('name', 'Namn');
        $form->email     = new UpMvc\Form\Text('email', 'E-postadress');
        $form->password  = new UpMvc\Form\Password('password', 'Lösenord');
        $form->password2 = new UpMvc\Form\Password('password2', 'Upprepa lösenord');
        $form->message   = new UpMvc\Form\Textarea('message', 'Meddelande');
        $form->sex       = new UpMvc\Form\Radio('sex', 'Ditt kön', array('male' => 'man', 'female' => 'kvinna'));
        $form->colour    = new UpMvc\Form\Checkbox('colour', 'Favoritfärger (välj två)', array('green' => 'grön', 'yellow' => 'gul', 'red' => 'röd', 'other' => 'annan'));
        $form->foundby   = new UpMvc\Form\Select('foundby', 'Hur hittade du hit?', array('google' => 'google', 'friends' => 'vänner', 'page' => 'annan sida'));
        $form->prefer    = new UpMvc\Form\SelectMultiple('prefer', 'Vad föredrar du?', array('car' => 'bil', 'bicycle' => 'cykel', 'motorcycle' => 'motorcykel', 'moped' => 'moped'));
        $form->submit    = new UpMvc\Form\Submit('submit', 'Skicka');
        $form->reset     = new UpMvc\Form\Reset('reset', 'Återställ');
        
        // Valideringsregler och felmeddelanden
        $form->name
             ->setRule(new UpMvc\Validation\Length(5,21))
             ->setError('Du måste skriva ett namn');
        
        $form->email
             ->setRule(new UpMvc\Validation\Email())
             ->setError('Du måste ange en e-postadress');
        
        $form->password
             ->setRule(new UpMvc\Validation\Length(4,8))
             ->setError('Du måste fylla i ett lösenord (minst 4 tecken)');
        
        $form->password2
             ->setRule(new UpMvc\Validation\Same($c->request->get('password'), $c->request->get('password2')))
             ->setError('Lösenorden är inte lika');
        
        $form->message
             ->setRule(new UpMvc\Validation\Length(2,2048))
             ->setError('Du måste skriva ett meddelande');
        
        $form->sex
             ->setRule(new UpMvc\Validation\Required())
             ->setError('Du måste ange ditt kön');
         
        $form->colour
             ->setRule(new UpMvc\Validation\Count(2,2))
             ->setError('Du måste välja exakt två färger');
        
        $form->foundby
             ->setRule(new UpMvc\Validation\Required())
             ->setError('Du måste välja ett alternativ');
        
        $form->prefer
             ->setRule(new UpMvc\Validation\Required())
             ->setError('Du måste välja vad du föredrar');
        
        // Fyll view med variabler och data och rendrera
        echo $c->view
            ->set('title', 'Exempelformulär - Up MVC')
            ->set('site_path', UpMvc\Container::get()->site_path)
            ->set('content', $form->render())
            ->render('UpMvc/View/layout.php');
    }
}