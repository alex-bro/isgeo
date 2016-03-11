<?php
class xml_parse
{
    private $xml, $dom, $node;
    function __construct($path) //При создании экземпляра класса в скобках будет необходимо указать путь к xml-документу
    {
        $this->dom = new domDocument('1.0');//Показываем, что в данном свойстве будет содержаться xml файл версии 1.0
        $this->dom->preserveWhiteSpace=false;//Таким образом мы решаем некоторые проблемы при работе с файлом. При сбросе этой переменной любая последовательность из пробелов и символов табуляции не будет восприниматься как текстовый элемент.
        $this->dom->formatOutput=true;//Данное свойство в значении true говорит  том, что при формировании и сохранении файла мы будем учитывать отступы. Каждый тег выводится с новой строки. Перед выводом тега формируется поле пробелов (отступ), длина которого определяется уровнем вложенности xml-элемента.
        $this->xml=$path; //Записываем путь к обрабатываемому файлу в свойство класса $this->xml
        $this->dom->load($this->xml); //Загружаем xml-документ в переменную
    }


    function xml_node($path)//Поиск определенного тега
    {
        $elements = explode ("->",$path);//Заносим каждый узел, лежащий на пути к необходимому тегу в массим. Т.е. в элементе $elements[0] будет находиться корневой_тег, в $elements[1]- тег1 и т.д.
        $this->node = $this->dom->documentElement;//Переходим к корневому элементу документа
        if (count($elements)>1)//определяем, нужно ли идти глубже, чем корневой элемент
        {
            for ($i=1; $i<count($elements); $i++)//Цикл для чтения всех элементов из массива $elements для движения к узлу назначения
            {
                $nodes = $this->node->childNodes;//Функция отвечающая за считывание количества сыновей  узла $this->node
                for ($j=0;$j<$nodes->length;$j++)//С помощью данного цикла мы будем проходить по всем сыновьям данного узла
                {
                    $child = $nodes->item($j);//Присваиваем указатель на очередной узел в переменную $child
                    if ($child->nodeName == $elements[$i]) $this->node=$child;//Проверяем, не является ли узел тем, к которому нам необходимо перейти, если да, тогда присваиваем указатель узла в переменную $this->node
                }
            }
        }
    }


    function xml_return_attribute_value($name) //Возвращает значение атрибута $name узла $this->node
    {
        $spisok=$this->node->attributes;//Считать количество атрибутов в переменную $spisok
        $attr = $spisok->getNamedItem($name);//Выбираем необходимый нам атрибут
        return $attr->nodeValue;//Возвращаем его значение

        /*for ($j=0;$j<$spisok->length; $j++)//Цикл для прохода по всем атрибутам узла
        {
                if ($spisok->item($j)->nodeName==$name)//Сравнение имени искомого узла с тем, который просматриваем
                {
                        return $spisok->item($j)->nodeValue;//Если имена совпали, возвращаем значение этого атрибута
                }
        }*/
    }


    function xml_return_node_value($teg=1) //Возвращает значение определенного узла. Переменная $teg указывает, необходимо ли заменять [ и ] на < и > при. Если ввести значение 0, тогда замена не будет произведена.
    {
        $exit = $this->node->nodeValue;//Присваиваем значение узла переменной $exit
        if ($teg==1){//Заменить [  на < , а ] на >
            $exit = str_replace("[","<", $exit);
            $exit = str_replace("]",">", $exit);
        }else
            if ($teg==2){//Совершить замену таким образом, чтобы в окно браузера вывелся не результат тега, а непосредственно сам тег
                $exit = str_replace("["," &lt ", $exit);
                $exit = str_replace("]"," &gt ", $exit);
            }
        return $exit;
    }

    function xml_update_node_value($value)//Функция изменения значения узла, переменная $value содержит в себе значение, которое необходимо записать в узел
    {
        $this->node->nodeValue = "$value"; //Присваиваем узлу значение
        unlink ($this->xml);//Удаляем xml файла, находящийся по адресу $this->xml
        $fx = fopen ($this->xml,w);//Создаем новый файл
        fwrite ($fx, $this->dom->saveXML());//Выводим в него значение всей переменной $this->dom
        fclose ($fx);//Зыкрываем дескриптор файла
    }


    function xml_length() //Возвращает количество узлов в списке
    {
        $nodeList = $this->node->childNodes;
        return $nodeList->length;
    }

}