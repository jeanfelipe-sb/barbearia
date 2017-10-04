<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * User mailer.
 */
class UserMailer extends Mailer {

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'User';

    public function welcome($user) {
        $this
                ->to($user->email)
                ->profile('canecas')
                ->emailFormat('html')
                ->layout('default')
                ->viewVars(['nome' => $user->name])
                ->subject(sprintf('Welcome %s', $user->name))
                ->template('welcome_mail_template');
    }

    public function recovery($user) {
        $this
                ->to($user[0]['email'])
                ->profile('canecas')
                ->emailFormat('html')
                ->layout('default')
                ->viewVars(['nome' => $user[0]['name'], 'email' => $user[0]['email'], 'hash'
                    => substr($user[0]['password'], 0, 25)])
                ->subject('Recuperação de senha ')
                ->template('recovery_mail_template');
    }

}
