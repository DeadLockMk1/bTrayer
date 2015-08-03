<?php

class AjaxController extends Controller
{
    public function actionGetFilterItem($n, $nn)
    {
        $command = new SitesView;
        $userId = Yii::app()->user->id;
        $filters = $command->getFilters($userId, $nn);
        $item = $filters->rawData[$n];
        $dict = new Dictionary;
        $d = $dict->getDescriptions();
        unset($dict);
        echo "<table class = 'items'>
            <thead>
                <tr>
                    <th class = 'itemGrid_c0 centred'>Field</th>
                    <th class = 'itemGrid_c1 centred'>Value</th>
                    <th class = 'itemGrid_c2 centred'>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr class = 'odd'>
                    <td class = 'lefted'>Pattern</td>
                    <td class = 'lefted'>" . $item["pattern"] . "</td>
                    <td class = 'hint'>{$d['SITES']['fPattern']}</td>
                </tr>
                <tr class = 'even'>
                    <td class = 'lefted'>State</td>
                    <td class = 'righted'>" . $item["state"] . "</td>
                    <td class = 'hint'>{$d['SITES']['fState']}</td>
                </tr>
                <tr class = 'odd'>
                    <td class = 'lefted'>Action</td>
                    <td class = 'righted'>" . $item["action"] . "</td>
                    <td class = 'hint'>{$d['SITES']['fAction']}</td>
                </tr>
                <tr class = 'even'>
                    <td class = 'lefted'>Stage</td>
                    <td class = 'righted'>" . $item["stage"] . "</td>
                    <td class = 'hint'>{$d['SITES']['fStage']}</td>
                </tr>
                <tr class = 'odd'>
                    <td class = 'lefted'>Operation code</td>
                    <td class = 'righted'>" . $item["opCode"] . "</td>
                    <td class = 'hint'>{$d['SITES']['fOperationCode']}</td>
                </tr>
                <tr class = 'even'>
                    <td class = 'lefted'>Subject</td>
                    <td class = 'righted'>" . $item["subject"] . "</td>
                    <td class = 'hint'>{$d['SITES']['fSubject']}</td>
                </tr>
                <tr class = 'odd'>
                    <td class = 'lefted'>Group ID</td>
                    <td class = 'righted'>" . $item["groupId"] . "</td>
                    <td class = 'hint'>{$d['SITES']['fGroupId']}</td>
                </tr>
                <tr class = 'even'>
                    <td class = 'lefted'>Mode</td>
                    <td class = 'righted'>" . $item["mode"] . "</td>
                    <td class = 'hint'>{$d['SITES']['fMode']}</td>
                </tr>
                <tr class = 'odd'>
                    <td class = 'lefted'>cDate</td>
                    <td class = 'lefted'>" . $item["cDate"] . "</td>
                </tr>
                <tr class = 'even'>
                    <td class = 'lefted'>uDate</td>
                    <td class = 'lefted'>" . $item["uDate"] . "</td>
                </tr>
            </tbody>
        </table>";
    }

    public function actionCleanLog()
    {
        $logPath = (Yii::app()->getBasePath() . '/runtime');
        $log = fopen($logPath . '/logger.log', 'w');
    }

    public function actionAddFilter()
    {
        $this->renderPartial('_addFilter', array(
        ));
    }
    public function actionAddProperty()
    {
        $this->renderPartial('_addProperty', array(
        ));
    }
    public function actionAddNewProperty()
    {
        $this->renderPartial('_addPropertyDialog', array(
        ));
    }
    public function actionTMaskModal()
    {
        $this->renderPartial('_genTMaskModal', array(
        ));
    }
}