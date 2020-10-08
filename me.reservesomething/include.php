<?
//  Me.ReserveMeeting Include-file
//
//  v 2.0
//
//  Created: 15-jul-2020


IncludeModuleLangFile(__FILE__);

// CMEWfReserveSomething class 
class CMEWfReserveSomething 
{
	// OnAfterCalendarEventEdit *** for future releases! ***
	/*
    function OnAfterCalendarEventEdit($arFields) 
	{

		
        if (CModule::IncludeModule('bizproc') && CModule::IncludeModule('iblock')) 
		{
            if 
			(   (  
			      (!$arFields['PARENT_ID'])  
			      || 
				  ($arFields['ID'] == $arFields['PARENT_ID']) 
				) 
				&& ($arFields['VERSION'] == 1)
			) 
			{
                $BP_ID = COption::GetOptionInt('me.reservemeeting', 'WF_ID');
                $WF_IBLOCK = COption::GetOptionInt('me.reservemeeting', 'WF_IBLOCK');
                $ME_MODE = COption::GetOptionString('me.reservemeeting', 'ME_MODE');

                $el = new CIBlockElement;
                global $USER;
                if ($ME_MODE == 'STANDALONE' && $BP_ID) 
				{


                    $documentId = $el->Add(array("IBLOCK_ID" => $BP_ID, "NAME"=>"newelement" ,"CREATED_BY" => $USER->GetID()));
                    $res = CBPDocument::GetWorkflowTemplatesForDocumentType(array("bizproc", "CBPVirtualDocument", "type_" . $BP_ID));
                    if ($bp_ex = each($res)) {
                        $workflowTemplateId = $bp_ex["value"]["ID"];
                    }
                    if (intval($arFields['ID']) > 0) {
                        $arrParams['EVENT_ID'] = $arFields['ID'];
                        $arrParams['AUTHOR_ID'] = $USER->GetID();
                        $wfId = CBPDocument::StartWorkflow(
                                        $workflowTemplateId, array("bizproc", "CBPVirtualDocument", $documentId), $arrParams, $arErrorsTmp
                        );
                    }
                } 
				elseif ($ME_MODE == 'LIST' && $WF_IBLOCK && $BP_ID) 
				{

                    $elemArField = array("IBLOCK_ID" => $WF_IBLOCK, "CREATED_BY" => $USER->GetID(), 'NAME' => $arFields['NAME']);
                    $documentId = $el->Add($elemArField, true);
                    $arErrorsTmp = array();
                    $arBizProcParametersValues = array();
                    if (\Bitrix\Main\Loader::includeModule("lists")) 
					{

                        $res = CBPDocument::StartWorkflow(
                                    intval($BP_ID), array("iblock", "CIBlockDocument", $documentId), $arBizProcParametersValues, $arErrorsTmp
                        );
                    }
                }
            }
			
			
        } // if (CModule::IncludeModule('bizproc')...
		
		
    } // OnAfterCalendarEventEdit func end
	
	*/
	

}//CMEWfReserveSomething class end

?>
