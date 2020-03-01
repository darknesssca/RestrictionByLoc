<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Entity\Base;

IncludeModuleLangFile(__FILE__);

class darknesssca_restbyloc extends CModule
{
    var $MODULE_ID = "darknesssca.restbyloc";
    var $MODULE_NAME;
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_DESCRIPTION;
    var $PARTNER_NAME;
    var $PARTNER_URI;
    var $LocalTable = 'Darknesssca\\RestByLoc\\PaySystemLocationTable';

    function __construct()
    {
        $this->MODULE_VERSION = "0.0.2";
        $this->MODULE_VERSION_DATE = "12.02.2020";
        $this->MODULE_NAME = Loc::getMessage('REST_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage("REST_MODULE_DESCRIPTION");
        $this->PARTNER_NAME = 'Darknesssca';
    }

    function DoInstall()
    {
        RegisterModule($this->MODULE_ID);
        $this->InstallDB();
        return true;
    }
//
    function DoUninstall()
    {
        $this->UnInstallDB();
        UnRegisterModule($this->MODULE_ID);
        return true;
    }

    function InstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            $connection = Application::getConnection();

            if (!$connection->isTableExists(Base::getInstance($this->LocalTable)->getDBTableName())
            ) {
                Base::getInstance($this->LocalTable)->createDbTable();
            }
        }
        return true;
    }

    function UnInstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            if (Application::getConnection()->isTableExists(Base::getInstance($this->LocalTable)->getDBTableName())) {
                Application::getConnection()->dropTable(Base::getInstance($this->LocalTable)->getDBTableName());
            }
        }
        return true;
    }
}