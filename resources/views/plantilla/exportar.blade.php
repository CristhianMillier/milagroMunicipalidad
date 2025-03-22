<table>
    <thead>
        <tr style="text-align: center;">
            <th colspan="18" style="text-align: center; font-size: 14px; font-weight: bold;">
                {{$plantilla->tipo_plantilla->nombre}}</th>
        </tr>
        <tr style="text-align: center;">
            <th colspan="18" style="text-align: center; font-size: 14px; font-weight: bold; font-style: italic;">
                {{$plantilla->mes}} - <?php echo date("Y"); ?></th>
        </tr>
        <tr style="border: 3px solid black; border-collapse: collapse; text-align: center;">
            <th colspan="6"
                style="border: 3px solid black; border-collapse: collapse; text-align: center; font-weight: bold">
                APELLIDOS Y
                NOMRBES</th>
            <th colspan="5"
                style="border: 3px solid black; border-collapse: collapse; text-align: center; font-weight: bold">
                HABERES
            </th>
            <th colspan="3"
                style="border: 3px solid black; border-collapse: collapse; text-align: center; font-weight: bold">
                DESCUENTOS
            </th>
            <th colspan="3"
                style="border: 3px solid black; border-collapse: collapse; text-align: center; font-weight: bold">
                APORTES DEL
                EMPLEADOR</th>
            <th colspan="1"
                style="border: 3px solid black; border-collapse: collapse; text-align: center; font-weight: bold"
                width="130px">
                FIRMA</th>
        </tr>
    </thead>
    <tbody style="border-collapse: collapse">
        @foreach($personasPlan as $plan)
        <?php
            $persona = \App\Models\Persona::find($plan->id);

            $haberes = \App\Models\Habere::where('persona_id', $plan->id)
            ->where('plantilla_id', $plantilla->id)
            ->select('nombre', 'monto')->get();

            $descuentos = \App\Models\Descuento::where('persona_id', $plan->id)
            ->where('plantilla_id', $plantilla->id)
            ->select('nombre', 'monto')->get();

            $aportes = \App\Models\Aporte::where('persona_id', $plan->id)
            ->where('plantilla_id', $plantilla->id)
            ->select('nombre', 'monto')->get();

            $totalHaber = 0.0;
            $totalDescuento = 0.0;
            $totalAporte = 0.0;

            foreach ($haberes as $haber) {
                $totalHaber += floatval($haber->monto);
            }
            foreach ($descuentos as $descuento) {
                $totalDescuento += floatval($descuento->monto);
            }
            foreach ($aportes as $aporte) {
                $totalAporte += floatval($aporte->monto);
            }
            $total = floatval($totalHaber) - floatval($totalDescuento);

            $numHaberes = count($haberes) - 1;
            $numDescuentos = count($descuentos) - 1;
            $numAportes = count($aportes) - 1;

            $contadorHabres = 0;
            $contadorDescuentos = 0;
            $contadorAportes = 0;
        ?>
        <tr style="border-collapse: collapse">
            <th colspan="6"
                style="font-size: 10px; font-weight: bold; border-top: 3px solid black; border-right: 3px solid black; border-left: 3px solid black">
                {{$persona->nombre}}
            </th>
            <th colspan="4" style="font-size: 10px; border-top: 3px solid black; border-left: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    $dataHaber = $haberes[$contadorHabres];
                    echo $dataHaber["nombre"];
                } else{
                    echo "";
                }
                ?> </th>
            <th colspan="1" style="font-size: 10px; border-top: 3px solid black; border-right: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    echo $dataHaber["monto"];
                    $contadorHabres++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-top: 3px solid black; border-left: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    $dataDescuentos = $descuentos[$contadorDescuentos];
                    echo $dataDescuentos["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-top: 3px solid black; border-right: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    echo $dataDescuentos["monto"];
                    $contadorDescuentos++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-top: 3px solid black; border-left: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    $dataAportes = $aportes[$contadorAportes];
                    echo $dataAportes["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-top: 3px solid black; border-right: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    echo $dataAportes["monto"];
                    $contadorAportes++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th
                style="font-size: 10px; border-top: 3px solid black; border-right: 3px solid black; border-left: 3px solid black">
            </th>
        </tr>

        <tr>
            <!-- Segunda Fila-->
            <th colspan="6" style="font-size: 10px; border-right: 3px solid black; border-left: 3px solid black">
            </th>
            <th colspan="4" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    $dataHaber = $haberes[$contadorHabres];
                    echo $dataHaber["nombre"];
                } else{
                    echo "";
                }
                ?> </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    echo $dataHaber["monto"];
                    $contadorHabres++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    $dataDescuentos = $descuentos[$contadorDescuentos];
                    echo $dataDescuentos["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    echo $dataDescuentos["monto"];
                    $contadorDescuentos++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    $dataAportes = $aportes[$contadorAportes];
                    echo $dataAportes["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    echo $dataAportes["monto"];
                    $contadorAportes++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th style="font-size: 10px; border-right: 3px solid black; border-left: 3px solid black">
            </th>
        </tr>

        <tr>
            <!-- Tercera Fila-->
            <th colspan="1" style="font-size: 10px; border-left: 3px solid black">
                CONDIC
            </th>
            <th colspan="1" style="font-size: 10px; width: 8px">
                :
            </th>
            <th colspan="1" style="font-size: 10px; width: 150px; font-weight: bold">
                {{$persona->contrato->nombre}}
            </th>
            <th colspan="1" style="font-size: 10px; width: 70px">
                FEC.NAC
            </th>
            <th colspan="1" style="font-size: 10px; width: 8px">
                :
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black; width: 80px">
                {{$persona->fecha_nacimiento}}
            </th>
            <th colspan="4" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    $dataHaber = $haberes[$contadorHabres];
                    echo $dataHaber["nombre"];
                } else{
                    echo "";
                }
                ?> </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    echo $dataHaber["monto"];
                    $contadorHabres++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    $dataDescuentos = $descuentos[$contadorDescuentos];
                    echo $dataDescuentos["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px;border-right: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    echo $dataDescuentos["monto"];
                    $contadorDescuentos++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    $dataAportes = $aportes[$contadorAportes];
                    echo $dataAportes["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    echo $dataAportes["monto"];
                    $contadorAportes++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th style="font-size: 10px; border-right: 3px solid black; border-left: 3px solid black">
            </th>
        </tr>

        <tr>
            <!-- Cuarta Fila-->
            <th colspan="1" style="font-size: 10px; border-left: 3px solid black">
                DNI Nº
            </th>
            <th colspan="1" style="font-size: 10px">
                :
            </th>
            <th colspan="1" style="font-size: 10px; text-align: left">
                {{$persona->dni}}
            </th>
            <th colspan="1" style="font-size: 10px">
                FEC.ING
            </th>
            <th colspan="1" style="font-size: 10px">
                :
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                {{$persona->fecha_ingreso}}
            </th>
            <th colspan="4" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    $dataHaber = $haberes[$contadorHabres];
                    echo $dataHaber["nombre"];
                } else{
                    echo "";
                }
                ?> </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    echo $dataHaber["monto"];
                    $contadorHabres++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    $dataDescuentos = $descuentos[$contadorDescuentos];
                    echo $dataDescuentos["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    echo $dataDescuentos["monto"];
                    $contadorDescuentos++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    $dataAportes = $aportes[$contadorAportes];
                    echo $dataAportes["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    echo $dataAportes["monto"];
                    $contadorAportes++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th style="font-size: 10px; border-right: 3px solid black; border-left: 3px solid black">
            </th>
        </tr>

        <tr>
            <!-- Quinta Fila-->
            <th colspan="1" style="font-size: 10px; border-left: 3px solid black">
                {{$persona->sistema_pension}}
            </th>
            <th colspan="1" style="font-size: 10px">
                :
            </th>
            <th colspan="1" style="font-size: 10px; font-weight: bold">
                {{$persona->tipo_sistema_pension}}
            </th>
            <th colspan="1" style="font-size: 10px">
                @if ($persona->regimene != null)
                {{$persona->regimene->nombre}}
                @endif
            </th>
            <th colspan="1" style="font-size: 10px">
                :
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                @if ($persona->regimene != null)
                {{$persona->regimene->tipo_regimene}}
                @endif
            </th>
            <th colspan="4" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    $dataHaber = $haberes[$contadorHabres];
                    echo $dataHaber["nombre"];
                } else{
                    echo "";
                }
                ?> </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    echo $dataHaber["monto"];
                    $contadorHabres++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    $dataDescuentos = $descuentos[$contadorDescuentos];
                    echo $dataDescuentos["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    echo $dataDescuentos["monto"];
                    $contadorDescuentos++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    $dataAportes = $aportes[$contadorAportes];
                    echo $dataAportes["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    echo $dataAportes["monto"];
                    $contadorAportes++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th style="font-size: 10px; border-right: 3px solid black; border-left: 3px solid black">
            </th>
        </tr>

        <tr>
            <!-- Sexta Fila-->
            <th colspan="1" style="font-size: 10px; border-left: 3px solid black">
                CUSP Nº
            </th>
            <th colspan="1" style="font-size: 10px">
                :
            </th>
            <th colspan="1" style="font-size: 10px">
                {{$persona->cusp}}
            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px;">

            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">

            </th>
            <th colspan="4" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    $dataHaber = $haberes[$contadorHabres];
                    echo $dataHaber["nombre"];
                } else{
                    echo "";
                }
                ?> </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    echo $dataHaber["monto"];
                    $contadorHabres++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    $dataDescuentos = $descuentos[$contadorDescuentos];
                    echo $dataDescuentos["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    echo $dataDescuentos["monto"];
                    $contadorDescuentos++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    $dataAportes = $aportes[$contadorAportes];
                    echo $dataAportes["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    echo $dataAportes["monto"];
                    $contadorAportes++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th style="font-size: 10px; border-right: 3px solid black; border-left: 3px solid black">
            </th>
        </tr>

        <tr>
            <!-- Septima Fila-->
            <th colspan="1" style="font-size: 10px; border-left: 3px solid black">

            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">

            </th>
            <th colspan="4" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    $dataHaber = $haberes[$contadorHabres];
                    echo $dataHaber["nombre"];
                } else{
                    echo "";
                }
                ?> </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    echo $dataHaber["monto"];
                    $contadorHabres++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    $dataDescuentos = $descuentos[$contadorDescuentos];
                    echo $dataDescuentos["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    echo $dataDescuentos["monto"];
                    $contadorDescuentos++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    $dataAportes = $aportes[$contadorAportes];
                    echo $dataAportes["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    echo $dataAportes["monto"];
                    $contadorAportes++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th style="font-size: 10px; border-right: 3px solid black; border-left: 3px solid black">
            </th>
        </tr>

        <tr>
            <!-- Octava Fila-->
            <th colspan="1" style="font-size: 10px; border-left: 3px solid black">

            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">

            </th>
            <th colspan="4" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    $dataHaber = $haberes[$contadorHabres];
                    echo $dataHaber["nombre"];
                } else{
                    echo "";
                }
                ?> </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    echo $dataHaber["monto"];
                    $contadorHabres++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    $dataDescuentos = $descuentos[$contadorDescuentos];
                    echo $dataDescuentos["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    echo $dataDescuentos["monto"];
                    $contadorDescuentos++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    $dataAportes = $aportes[$contadorAportes];
                    echo $dataAportes["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    echo $dataAportes["monto"];
                    $contadorAportes++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th style="font-size: 10px; border-right: 3px solid black; border-left: 3px solid black">
            </th>
        </tr>

        <tr>
            <!-- Novena Fila-->
            <th colspan="1" style="font-size: 10px; border-left: 3px solid black">

            </th>
            <th colspan="1" style="font-size: 10px;">

            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px;">

            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">

            </th>
            <th colspan="4" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    $dataHaber = $haberes[$contadorHabres];
                    echo $dataHaber["nombre"];
                } else{
                    echo "";
                }
                ?> </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorHabres <= $numHaberes){
                    echo $dataHaber["monto"];
                    $contadorHabres++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    $dataDescuentos = $descuentos[$contadorDescuentos];
                    echo $dataDescuentos["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorDescuentos <= $numDescuentos){
                    echo $dataDescuentos["monto"];
                    $contadorDescuentos++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th colspan="2" style="font-size: 10px; border-left: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    $dataAportes = $aportes[$contadorAportes];
                    echo $dataAportes["nombre"];
                } else{
                    echo "";
                }
                ?>
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                <?php
                if ($contadorAportes <= $numAportes){
                    echo $dataAportes["monto"];
                    $contadorAportes++;
                } else{
                    echo "";
                }
                ?>
            </th>

            <th style="font-size: 10px; border-right: 3px solid black; border-left: 3px solid black">
            </th>
        </tr>

        <tr>
            <!-- Decima Fila-->
            <th colspan="1" style="font-size: 10px; border-left: 3px solid black">
                CARGO
            </th>
            <th colspan="1" style="font-size: 10px;">
                :
            </th>
            <th colspan="1" style="font-size: 10px; font-weight: bold">
                {{$persona->cargo->nombre}}
            </th>
            <th colspan="1" style="font-size: 10px">
                DIAS LABOR
            </th>
            <th colspan="1" style="font-size: 10px;">
                :
            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">
                {{$persona->dias_labor}}
            </th>
            <th colspan="2"
                style="font-size: 10px; border-top: 3px dotted black; border-left: 3px solid black; border-bottom: 3px solid black; text-align: center; font-weight: bold">
                TOTAL
            </th>
            <th colspan="1"
                style="font-size: 10px; border-top: 3px dotted black; border-bottom: 3px solid black; text-align: center; font-weight: bold">
                {{$totalHaber}}
            </th>
            <th colspan="1"
                style="font-size: 10px; border-top: 3px dotted black; border-bottom: 3px solid black; text-align: center; font-weight: bold">
                R.Aseg.
            </th>
            <th colspan="1"
                style="font-size: 10px; border-top: 3px dotted black; border-bottom: 3px solid black; text-align: center; font-weight: bold; border-right: 3px solid black">
                {{$totalHaber}}
            </th>

            <th colspan="2"
                style="font-size: 10px; border-top: 3px dotted black; border-left: 3px solid black; border-bottom: 3px solid black; text-align: center; font-weight: bold">
                Total Descuentos
            </th>
            <th colspan="1"
                style="font-size: 10px; border-top: 3px dotted black; border-right: 3px solid black; border-bottom: 3px solid black; text-align: center; font-weight: bold">
                {{$totalDescuento}}
            </th>

            <th colspan="2"
                style="font-size: 10px; border-top: 3px dotted black; border-left: 3px solid black; border-bottom: 3px solid black; text-align: center; font-weight: bold">
                Total Aportes
            </th>
            <th colspan="1"
                style="font-size: 10px; border-top: 3px dotted black; border-right: 3px solid black; border-bottom: 3px solid black; text-align: center; font-weight: bold">
                {{$totalAporte}}
            </th>

            <th
                style="font-size: 10px; border-right: 3px solid black; border-left: 3px solid black; border-bottom: 3px solid black">
            </th>
        </tr>

        <tr>
            <!-- Onceava Fila-->
            <th colspan="1" style="font-size: 10px; border-left: 3px solid black; border-bottom: 3px solid black">

            </th>
            <th colspan="1" style="font-size: 10px; border-bottom: 3px solid black">

            </th>
            <th colspan="1" style="font-size: 10px; border-bottom: 3px solid black">

            </th>
            <th colspan="1" style="font-size: 10px; border-bottom: 3px solid black">

            </th>
            <th colspan="1" style="font-size: 10px">

            </th>
            <th colspan="1" style="font-size: 10px; border-right: 3px solid black">

            </th>
            <th colspan="11" style="font-size: 10px; border: 3px solid black; text-align: center; font-weight: bold">
                IMPORTE PAGADO A {{$persona->nombre}}:
            </th>

            <th style="font-size: 10px; border: 3px solid black; text-align: right; font-weight: bold">
                {{$total}}
            </th>
        </tr>
        @endforeach

        <tr>
            <!-- Final Fila-->
            <th colspan="6"
                style="font-size: 12px; border: 3px solid black; text-align: center; font-weight: bold; text-decoration: underline;">
                R E S U M E N P L A N I L L A
            </th>

            <th colspan="4"
                style="font-size: 10px; border-bottom: 3px solid black; border-left: 3px solid black; border-top: 3px solid black; text-align: center; font-weight: bold">
                H A B E R E S
            </th>
            <th colspan="1"
                style="font-size: 10px; border-bottom: 3px solid black; border-right: 3px solid black; border-top: 3px solid black; text-align: center; font-weight: bold">
                {{$plantilla->monto_haberes}}
            </th>

            <th colspan="2"
                style="font-size: 10px; border-bottom: 3px solid black; border-left: 3px solid black; border-top: 3px solid black; text-align: center; font-weight: bold">
                D E S C U E N T O S
            </th>
            <th colspan="1"
                style="font-size: 10px; border-bottom: 3px solid black; border-right: 3px solid black; border-top: 3px solid black; text-align: center; font-weight: bold">
                {{$plantilla->monto_descuentos}}
            </th>

            <th colspan="2"
                style="font-size: 10px; border-bottom: 3px solid black; border-left: 3px solid black; border-top: 3px solid black; text-align: center; font-weight: bold">
                A P O R T E S
            </th>
            <th colspan="1"
                style="font-size: 10px; border-bottom: 3px solid black; border-right: 3px solid black; border-top: 3px solid black; text-align: center; font-weight: bold">
                {{$plantilla->monto_aportes}}
            </th>

            <th colspan="1" style="font-size: 10px; border: 3px solid black; text-align: right; font-weight: bold">
                {{$plantilla->monto_total}}
            </th>
        </tr>
    </tbody>
</table>