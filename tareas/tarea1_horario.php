<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Horario</title>
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #E00034;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Horario</h1>

<table>
    <thead>
        <tr>
            <th>Hora</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>7:00 AM - 8:00 AM</td>
            <td colspan="2" rowspan="2">Arquitectura Web</td>
			<td></td>
            <td rowspan="2">Arquitectura Web</td>
            <td></td>
        </tr>
		<tr>
            <td>8:00 AM - 9:00 AM</td>
            <td></td>
			<td></td>

        </tr>
        <tr>
            <td>9:00 AM - 11:00 AM</td>
            <td></td>
            <td rowspan="2">Administración</td>
            <td></td>
            <td rowspan="2">Administración</td>
            <td></td>
        </tr>
        <tr>
            <td>10:00 AM - 11:00 AM</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>11:00 AM - 3:00 PM</td>
            <td>React</td>
            <td></td>
            <td>React</td>
            <td></td>
            <td>React</td>
        </tr>
        <tr>
            <td>4:00 PM - 5:00 PM</td>
            <td></td>
            <td rowspan="2">Guitarra</td>
            <td></td>
            <td rowspan="2">Guitarra</td>
            <td></td>
        </tr>
        <tr>
            <td>5:00 PM - 6:00 PM</td>
            <td rowspan="3">Fundamentos de redes</td>
            <td rowspan="3">Fundamentos de redes</td>
            <td></td>
        </tr>
        <tr>
            <td>6:00 PM - 7:00 PM</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>7:00 PM - 8:00 PM</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

</body>
</html>

