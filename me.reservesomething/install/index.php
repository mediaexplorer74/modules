<?
//  Me.ReserveSomething Install 
//  v 2.0
//
//  Created: 08-oct-2020

IncludeModuleLangFile(__FILE__);


if (class_exists("me_reservesomething"))
    return;

Class me_reservesomething extends CModule 
{

    var $MODULE_ID = "me.reservesomething";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS = "Y";

    // me_reservesomething
    function me_reservesomething() 
	{
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path . "/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) 
		{
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        } else {
            $this->MODULE_VERSION = WF_FROM_CALENDER_VERSION;
            $this->MODULE_VERSION_DATE = WF_FROM_CALENDER_VERSION_DATE;
        }

        $this->MODULE_NAME = "RESERVE SOMETHING"; //GetMessage("ME_WF_RESERVE_SOMETHING_MODULE_NAME");
        $this->MODULE_DESCRIPTION = "RESERVE SOMETHING";//GetMessage("ME_WF_RESERVE_SOMETHING_MODULE_DESCRIPTION");

        $this->PARTNER_NAME = "ME"; //GetMessage("PARTNER_NAME");
        $this->PARTNER_URI = "http://me.com/";
    }

	// DoInstall
    function DoInstall() 
	{

        if (!IsModuleInstalled("me.reservesomething")) 
		{
            $this->InstallDB();
            $this->InstallEvents();
            $this->InstallFiles();
        }
        return true;
    }

	// DoUnInstall
    function DoUninstall() 
	{
        $this->UnInstallDB();
        $this->UnInstallEvents();
        $this->UnInstallFiles();

        return true;
    }

	// InstallDB
    function InstallDB() 
	{

        RegisterModule("me.reservesomething");
        return true;
    }
	
	
	// UnInstallDB
    function UnInstallDB() {

        UnRegisterModule("me.reservesomething");
        return true;
    }

    // InstallEvents
    function InstallEvents() 
	{
		// TODO
		
		/*
        RegisterModuleDependences("calendar", "OnAfterCalendarEventEdit", "me.reservesomething", 'CMEWfReserveMeeting', 'OnAfterCalendarEventEdit');
		*/
		
        return true;
    }

    // UnInstallEvents
    function UnInstallEvents() 
	{
		// TODO
		
		/*
        UnRegisterModuleDependences("calendar", "OnAfterCalendarEventEdit", "me.reservesomething", 'CMEWfReserveMeeting', 'OnAfterCalendarEventEdit');
		*/
		
        return true;
    }

	// InstallFiles
    function InstallFiles() 
	{
				
		// 1 копирование файлов компонента some.edit
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/me.reservesomething/install/components/me/some.edit/", $_SERVER["DOCUMENT_ROOT"]."/local/components/me/some.edit/", true, true);
		
		// 2 копирование "блока вызова" компонента some.edit
		 if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/me.reservesomething/install/public'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT']."/".$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}
		
        return true;
    }

	// UnInstallFiles
    function UnInstallFiles() 
	{
		// 1 удаление файлов компонента some.edit
		DeleteDirFilesEx("/local/components/me/some.edit/");
		
		// 2 удаление "блока вызова" компонента some.edit
		DeleteDirFilesEx("/some/");
		
        return true;
    }

}
?>