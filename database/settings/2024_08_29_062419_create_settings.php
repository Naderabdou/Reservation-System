<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name_ar', 'موقعي');
        $this->migrator->add('general.site_name_en', 'My website');


        $this->migrator->add('general.logo', 'This is my website');



        $this->migrator->add('general.favicon', 'This is my website');



        $this->migrator->add('general.phone', '');
        $this->migrator->add('general.email', '');
        $this->migrator->add('general.whatsapp', '');
        $this->migrator->add('general.appStore', '');
        $this->migrator->add('general.googlePlay', '');
        $this->migrator->add('general.support_link', '');
        $this->migrator->add('general.facebook', '');
        $this->migrator->add('general.instagram', '');
        $this->migrator->add('general.address', '');
        $this->migrator->add('general.location', '');



        $this->migrator->add('general.about_desc_ar', '');
        $this->migrator->add('general.about_desc_en', '');





        $this->migrator->add('general.policy_desc_ar', '');
        $this->migrator->add('general.policy_desc_en', '');




    }
};
