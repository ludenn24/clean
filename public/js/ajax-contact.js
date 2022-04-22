<
    ? php
    include
'Clases/cls_menu_category.php';
include
'Clases/cls_menu_item.php';

$category = new Cls_MenuCategory();
$c = $category->getMenuCategory();
$posicion = @$_REQUEST['pos'];
$formulario = @$_REQUEST['form'];
    ?
>
<
section
class
= "sidebar" >
    < !--Sidebar
user
panel-- >
< div
class
= "user-panel" >
    < div
class
= "pull-left image" >
    < img
src = "dist/img/logini.jpg"
class
= "img-circle"
alt = "User Image" >
    < /div>
    < div
class
= "pull-left info" >
< p > < ? php echo
$_SESSION['ses_nombreuser'];
    ?
><
/p>
< p > < a
href = ""
target = "_blank" > Ir
a
la
web < /a></
p >
< /div>
< /div>
<!-- sidebar menu: : style can be found in sidebar.less -->
< ul
class
= "sidebar-menu" >
    < li
class
= "header" > Menú
Navegación < /li>

< !--
< ? php
for ($i = 0; $i < sizeof($c); $i++) {
    $item = new Cls_MenuItem();
    $m = $item->getMenuItem($c[$i]['idcategory']);
    if (count($m) > 0) {
            ?
    >
    <
        li
    class
        = "treeview <?php if($c[$i]['posicion']==$posicion){echo "
        active
        ";} ?>" >
        < a
        href = "#"
        data - content = "raiz" >
            < i
    class
        = "fa fa-files-o" > < /i>
        < span > < ? php echo
        $c[$i]['nombre'];
            ?
    ><
        /span>
        < span
    class
        = "label label-primary pull-right" > < ? php echo
        sizeof($m) ?
    ><
        /span>
        < /a>
        < ul
    class
        =
    <
            ? php
        if ($c[$i]['posicion'] == $posicion) {
            echo
            "'treeview-menu menu-open' style='display:block;'";
        } else {
            echo
            "'treeview-menu' style='display:none;'";
        }
            ?
    >>
    <
            ? php
        for ($x = 0; $x < sizeof($m); $x++) {
                ?
        >
        <
            li < ? php
            if ($m[$x]['iditem'] == $formulario) {
                echo
                "class='activeli'";
            }
                ?
        >>
        <
            a
            href = "dbpanel.php?view=<?php echo $m[$x]['tag'] ?>&form=<?php echo $m[$x]['iditem'] ?>&pos=<?php echo $c[$i]['posicion'];?>"
            style = "cursor:pointer;" >
                < i
        class
            = "fa fa-newspaper-o" > < /i><span><?php echo $m[$x]['nombre'] ?></s
            pan >
            < /a>
            < /li>
            < ? php
        }
            ?
    >
    <
        /ul>
        < /li>
        < ? php
    }
}
    ?
>
-- >

< li
class
= "treeview" >
    < a
href = "#" >
    < i
class
= "fa fa-university" > < /i><span>CERCADO DE LIMA</s
pan >
< span
class
= "pull-right-container" >
    < i
class
= "fa fa-angle-left pull-right" > < /i>
    < /span>
    < /a>
    < ul
class
= "treeview-menu"
style = "display: block;" >
    < li
class
= "treeview" >
    < a
href = "#" > < i
class
= "fa fa-book" > < /i> Asiento Principal
    < span
class
= "pull-right-container" >
    < i
class
= "fa fa-angle-left pull-right" > < /i>
    < /span>
    < /a>
    < ul
class
= "treeview-menu"
style = "display: block;" >
    < li > < a
href = "dbpanel.php?view=m-pendientes&amp;form=1&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Pendientes</
a > < /li>
< li > < a
href = "dbpanel.php?view=m-aprobadas&amp;form=2&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Aprobadas</
a > < /li>
< li > < a
href = "dbpanel.php?view=m-incompletos&amp;form=3&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Incompletas</
a > < /li>
< li > < a
href = "dbpanel.php?view=m-archivadas&amp;form4=&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Archivadas</
a > < /li>
< /ul>
< /li>

< li
class
= "treeview"
style = "height: auto;" >
    < a
href = "#" > < i
class
= "fa fa-book" > < /i> Asiento Secundario
    < span
class
= "pull-right-container" >
    < i
class
= "fa fa-angle-left pull-right" > < /i>
    < /span>
    < /a>
    < ul
class
= "treeview-menu"
style = "display: block;" >
    < li > < a
href = "dbpanel.php?view=s-pendientes&amp;form=1&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Pendientes</
a > < /li>
< li > < a
href = "dbpanel.php?view=s-aprobadas&amp;form=2&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Aprobadas</
a > < /li>
< li > < a
href = "dbpanel.php?view=s-incompletos&amp;form=3&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Incompletas</
a > < /li>
< li > < a
href = "dbpanel.php?view=s-archivadas&amp;form4=&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Archivadas</
a > < /li>
< /ul>
< /li>

< li
class
= "treeview menu-open"
style = "height: auto;" >
    < a
href = "dbpanel.php?view=a-solicitudes&amp;form=1&amp;pos=4" > < i
class
= "fa fa-book" > < /i> Todas las solicitudes
    < /a>
    < /li>


    < /ul>
    < /li>

    < li
class
= "treeview"
style = "height: auto;" >
    < a
href = "#" >
    < i
class
= "fa fa-share" > < /i><span>INTERDISTRITALES</s
pan >
< span
class
= "pull-right-container" >
    < i
class
= "fa fa-angle-left pull-right" > < /i>
    < /span>
    < /a>
    < ul
class
= "treeview-menu"
style = "display: block;" >

    < li
class
= "treeview menu-open"
style = "height: auto;" >
    < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i> Asiento Principal
    < span
class
= "pull-right-container" >
    < i
class
= "fa fa-angle-left pull-right" > < /i>
    < /span>
    < /a>
    < ul
class
= "treeview-menu"
style = "display: block;" >
    < li > < a
href = "dbpanel.php?view=sd-pendientes&amp;form=1&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Pendientes</
a > < /li>
< li > < a
href = "dbpanel.php?view=sd-aprobadas&amp;form=2&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Aprobadas</
a > < /li>
< li > < a
href = "dbpanel.php?view=sd-incompletos&amp;form=3&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Incompletas</
a > < /li>
< li > < a
href = "dbpanel.php?view=sd-archivadas&amp;form=4&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Archivadas</
a > < /li>
< /ul>
< /li>

< li
class
= "treeview menu-open"
style = "height: auto;" >
    < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i> Asiento Secundario
    < span
class
= "pull-right-container" >
    < i
class
= "fa fa-angle-left pull-right" > < /i>
    < /span>
    < /a>
    < ul
class
= "treeview-menu"
style = "display: block;" >
    < li > < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i>Pendientes</
a > < /li>
< li > < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i>Aprobadas</
a > < /li>
< li > < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i>Incompletas</
a > < /li>
< li > < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i>Archivadas</
a > < /li>
< /ul>
< /li>

< /ul>
< /li>

< li
class
= "treeview"
style = "height: auto;" >

    < a
href = "#" >

    < i
class
= "fa fa-share" > < /i><span>INTERDISTRITALES</s
pan >

< span
class
= "pull-right-container" >

    < i
class
= "fa fa-angle-left pull-right" > < /i>

    < /span>

    < /a>

    < ul
class
= "treeview-menu"
style = "display: block;" >


    < li
class
= "treeview menu-open"
style = "height: auto;" >

    < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i> Asiento Principal

    < span
class
= "pull-right-container" >

    < i
class
= "fa fa-angle-left pull-right" > < /i>

    < /span>

    < /a>

    < ul
class
= "treeview-menu"
style = "display: block;" >

    < li > < a
href = "dbpanel.php?view=sd-pendientes&amp;form=1&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Pendientes</
a > < /li>

< li > < a
href = "dbpanel.php?view=sd-aprobadas&amp;form=2&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Aprobadas</
a > < /li>

< li > < a
href = "dbpanel.php?view=sd-incompletos&amp;form=3&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Incompletas</
a > < /li>

< li > < a
href = "dbpanel.php?view=sd-archivadas&amp;form=4&amp;pos=4" > < i
class
= "fa fa-circle-o" > < /i>Archivadas</
a > < /li>

< /ul>

< /li>


< li
class
= "treeview menu-open"
style = "height: auto;" >

    < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i> Asiento Secundario

    < span
class
= "pull-right-container" >

    < i
class
= "fa fa-angle-left pull-right" > < /i>

    < /span>

    < /a>

    < ul
class
= "treeview-menu"
style = "display: block;" >

    < li > < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i>Pendientes</
a > < /li>

< li > < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i>Aprobadas</
a > < /li>

< li > < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i>Incompletas</
a > < /li>

< li > < a
href = "#" > < i
class
= "fa fa-circle-o" > < /i>Archivadas</
a > < /li>

< /ul>

< /li>


< /ul>

< /li>


< /ul>

< /section>
