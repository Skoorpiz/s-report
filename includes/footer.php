</body>
</html>
<script>
    jQuery(function($){
        $.datepicker.regional['fr'] = {
            monthNames: ['Janvier','Fevrier','Mars','Avril','Mai','Juin',
                'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
            monthNamesShort: ['Jan','Fev','Mar','Avr','Mai','Jun',
                'Jul','Aou','Sep','Oct','Nov','Dec'],
            dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
            dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
            dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
        };
        $.datepicker.setDefaults($.datepicker.regional['fr']);
    });
    $(function () {
        $(".datepicker").datepicker({
        });
    });
</script>
<?php
    $pdo = null;