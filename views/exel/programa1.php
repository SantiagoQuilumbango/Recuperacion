<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análisis de Sensibilidad</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="sensitivity-analysis">
        <h2>Análisis de Sensibilidad</h2>
        <table id="predictions-table">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Eficiencia de la Aplicación Web (%)</th>
                    <th>Libros Prestados</th>
                </tr>
            </thead>
            <tbody id="predictions-body">
                <tr class="first-three">
                    <td>Mes 1</td>
                    <td><input type="number" id="PE1" class="efficiency-input" value="80" min="0" max="100"></td>
                    <td class="sales first-row"><input type="number" id="VG1" class="sales-input" value="150" min="0"></td>
                </tr>
                <tr class="first-three">
                    <td>Mes 2</td>
                    <td><input type="number" id="PE2" class="efficiency-input" value="85" min="0" max="100"></td>
                    <td class="sales first-row"><input type="number" id="VG2" class="sales-input" value="180" min="0"></td>
                </tr>
                <tr class="first-three">
                    <td>Mes 3</td>
                    <td><input type="number" id="PE3" class="efficiency-input" value="90" min="0" max="100"></td>
                    <td class="sales first-row"><input type="number" id="VG3" class="sales-input" value="200" min="0"></td>
                </tr>
                <!-- Filas para los próximos meses -->
                <tr class="next-three">
                    <td>Mes 4</td>
                    <td><input type="number" id="PE4" class="efficiency-input" value="95" min="0" max="100"></td>
                    <td class="sales next-row" id="VG4">?</td>
                </tr>
                <tr class="next-three">
                    <td>Mes 5</td>
                    <td><input type="number" id="PE5" class="efficiency-input" value="90" min="0" max="100"></td>
                    <td class="sales next-row" id="VG5">?</td>
                </tr>
                <tr class="next-three">
                    <td>Mes 6</td>
                    <td><input type="number" id="PE6" class="efficiency-input" value="85" min="0" max="100"></td>
                    <td class="sales next-row" id="VG6">?</td>
                </tr>
            </tbody>
        </table>
        <button id="predict-button">Predecir Prestamos para Próximos Meses</button>
        <div id="predictions-container"></div>
    </div>

    <script src="programa1.js"></script>
    <link rel="stylesheet" href="programa1.css">
</body>
</html>
