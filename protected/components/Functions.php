<?php
class Functions {
    //создаем каталог
    public static function createPathUploadsNow($rand=true){
        $target0 = $_SERVER['DOCUMENT_ROOT'].Options::getOption('imgPath').'/'.date('Y');
        $target1 = $_SERVER['DOCUMENT_ROOT'].Options::getOption('imgPath').'/'.date('Y').'/'.date('m');
        $target2 = $_SERVER['DOCUMENT_ROOT'].Options::getOption('imgPath').'/'.date('Y').'/'.date('m').'/'.date('d');
        if ($rand) $target3 = $_SERVER['DOCUMENT_ROOT'].Options::getOption('imgPath').'/'.date('Y').'/'.date('m').'/'.date('d').'/'.self::random(8);
        else $target3 = $_SERVER['DOCUMENT_ROOT'].Options::getOption('imgPath').'/'.date('Y').'/'.date('m').'/'.date('d');
        if(!is_dir($target0)) mkdir($target0);
        if(!is_dir($target1)) mkdir($target1);
        if(!is_dir($target2)) mkdir($target2);
        if(!is_dir($target3)) {mkdir($target3); chmod($target3, 0777);}
        if(is_dir($target3)) return $target3;
        return false;
    }
    //генератор случайных чисел
    public static function random($number=8){
        $res='';
        for($k=1;$k<=$number;$k++){
            $str = (string)mt_rand(0,abs(crc32(microtime())));
            $res .= $str[mt_rand(0,strlen($str)-1)];
        }
        return $res;
    }
    // парсим хмл
    public static function parseXml($firstLoadXml){
        $fullName = $firstLoadXml['path'].'/'.$firstLoadXml['filename'];
        if (file_exists($fullName)) {
             $xml = simplexml_load_file($fullName);
             $arr['Description'] = $xml->InfoPart->CadastralZoneInfo->CadastralQuarters->CadastralQuarterInfo->Parcels->ParcelInfo->ParcelMetricInfo->Description;
             $arr['Size'] = $xml->InfoPart->CadastralZoneInfo->CadastralQuarters->CadastralQuarterInfo->Parcels->ParcelInfo->ParcelMetricInfo->Area->Size;
             $arr['Region'] = $xml->InfoPart->CadastralZoneInfo->CadastralQuarters->CadastralQuarterInfo->Parcels->ParcelInfo->ParcelLocationInfo->Region;
             $arr['Settlement'] = $xml->InfoPart->CadastralZoneInfo->CadastralQuarters->CadastralQuarterInfo->Parcels->ParcelInfo->ParcelLocationInfo->Settlement;
             $arr['District'] = $xml->InfoPart->CadastralZoneInfo->CadastralQuarters->CadastralQuarterInfo->Parcels->ParcelInfo->ParcelLocationInfo->District;
             $arr['FullName'] = $xml->InfoPart->CadastralZoneInfo->CadastralQuarters->CadastralQuarterInfo->Parcels->ParcelInfo->Proprietors->ProprietorInfo->Authentication->NaturalPerson->FullName;
             $arr['StreetName'] = $xml->InfoPart->CadastralZoneInfo->CadastralQuarters->CadastralQuarterInfo->Parcels->ParcelInfo->ParcelLocationInfo->ParcelAddress->StreetName;
             $arr['Building'] = $xml->InfoPart->CadastralZoneInfo->CadastralQuarters->CadastralQuarterInfo->Parcels->ParcelInfo->ParcelLocationInfo->ParcelAddress->Building;
             $arr['KOATUU'] = $xml->InfoPart->CadastralZoneInfo->KOATUU;
             $arr['CadastralZoneNumber'] = $xml->InfoPart->CadastralZoneInfo->CadastralZoneNumber;
             $arr['CadastralQuarterNumber'] = $xml->InfoPart->CadastralZoneInfo->CadastralQuarters->CadastralQuarterInfo->CadastralQuarterNumber;
             $arr['ParcelID'] = $xml->InfoPart->CadastralZoneInfo->CadastralQuarters->CadastralQuarterInfo->Parcels->ParcelInfo->ParcelMetricInfo->ParcelID;
            return $arr;
        } else {
            exit('Не удалось открыть файл ');
        }

    }
    // добавляем инфо в хмл
    public static function addUrlToXml($path, $url){
        if (file_exists($path)) {
            $xml = simplexml_load_file($path);
            $xml->InfoPart->CadastralZoneInfo->CadastralQuarters->CadastralQuarterInfo->Parcels->ParcelInfo->ParcelMetricInfo->Description = $url;
            file_put_contents($path,$xml->asXML());
        }
    }
    // найти коды полажения участка
    public static function findArea($xml){
        $res = [];
        $domain = Domain::model()->find('name=:name', array(':name'=>$xml[0]));
        if($domain !== null){
            $res[] = $domain->id;
            $criteria = new CDbCriteria();
            $criteria->select='id';
            $criteria->condition='name=:name AND domain_id=:domain_id';
            $criteria->params=array(':name'=>$xml[1], ':domain_id'=>$res[0]);
            $region = Region::model()->find($criteria);
            if($region !== null){
                $res[] = $region->id;
                $criteria = new CDbCriteria();
                $criteria->select='id';
                $criteria->condition='name=:name AND region_id=:region_id';
                $criteria->params=array(':name'=>$xml[2], ':region_id'=>$res[1]);
                $area = Area::model()->find($criteria);
                if($area !== null){
                    $res[] = $area->id;
                    return $res;
                } else {$res[] = 0; return $res;}
            } else {$res[] = 0; $res[] = 0; return $res;}
        } else return [0,0,0];
    }
}
