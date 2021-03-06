<?php
/**
 * /Documentation/Controller/WebForm.php
 *
 * @package UpMvc2\Documentation
 */

namespace Documentation\Controller;

use UpMvc;
use UpMvc\Form as Form;
use UpMvc\Container as Up;
use UpMvc\Validation as Validation;

/**
 * Controller för exempelformulär.
 *
 * @package UpMvc2\Documentation
 * @author  Ola Waljefors
 * @version 2013.12.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Webform
{
    /** Default action */
    public function index()
    {
        // Skapa ett webb-formulär
        $form = new Form('post', Up::site_path().'/Documentation/WebForm/');
        $form->setId('myform');

        // Sätt upp formulärets fält
        $form->name      = new Form\Text('name', 'Namn');
        $form->email     = new Form\Text('email', 'E-postadress');
        $form->password  = new Form\Password('password', 'Lösenord');
        $form->password2 = new Form\Password('password2', 'Upprepa lösenord');
        $form->message   = new Form\Textarea('message', 'Meddelande');
        $form->sex       = new Form\Radio('sex', 'Ditt kön', array('male' => 'man', 'female' => 'kvinna'));
        $form->colour    = new Form\Checkbox('colour', 'Favoritfärger (välj två)', array('green' => 'grön', 'yellow' => 'gul', 'red' => 'röd', 'other' => 'annan'));
        $form->foundby   = new Form\Select('foundby', 'Hur hittade du hit?', array('google' => 'google', 'friends' => 'vänner', 'page' => 'annan sida'));
        $form->prefer    = new Form\SelectMultiple('prefer', 'Vad föredrar du?', array('car' => 'bil', 'bicycle' => 'cykel', 'motorcycle' => 'motorcykel', 'moped' => 'moped'));
        $form->submit    = new Form\Submit('submit', 'Skicka');
        $form->reset     = new Form\Reset('reset', 'Återställ');

        // Valideringsregler och felmeddelanden
        $form
            ->name
            ->setRule(new Validation\Length(5, 21))
            ->setError('Du måste skriva ett namn');

        $form
            ->email
            ->setRule(new Validation\Email())
            ->setError('Du måste ange en e-postadress');

        $form
            ->password
            ->setRule(new Validation\Length(4, 8))
            ->setError('Du måste fylla i ett lösenord (minst 4 tecken)');

        $form
            ->password2
            ->setRule(new Validation\Same(Up::request()->get('password'), Up::request()->get('password2')))
            ->setError('Lösenorden är inte lika');

        $form->message
            ->setRule(new Validation\Length(2, 2048))
            ->setError('Du måste skriva ett meddelande');

        $form
            ->sex
            ->setRule(new Validation\Required())
            ->setError('Du måste ange ditt kön');

        $form
            ->colour
            ->setRule(new Validation\Count(2, 2))
            ->setError('Du måste välja exakt två färger');

        $form
            ->foundby
            ->setRule(new Validation\Required())
            ->setError('Du måste välja ett alternativ');

        $form
            ->prefer
            ->setRule(new Validation\Required())
            ->setError('Du måste välja vad du föredrar');

        // Fyll view med variabler och data och rendrera
        echo Up::view()
            ->set('title', 'Exempelformulär - Up MVC')
            ->set('site_path', Up::site_path())
            ->set('content', $form->render())
            ->setPath('Documentation/')
            ->render('View/layout.php');
    }
}
