<?php
require_once 'fpdf/fpdf.php';

class Presupuesto {
    private $pdf;
    private $db;  

    public function __construct() {
        $this->pdf = new FPDF();
        $this->db = new mysqli("smtp187.controlvps.com", "webit", "Artigas77", "webmayoitnuke");
        if ($this->db->connect_error) {
            die("Error al conectar a la base de datos: " . $this->db->connect_error);
        }
    }

    public function getPresupuestos($fecha_inicio, $fecha_fin, $tipo_presupuesto) {
        $query = "SELECT * FROM presupuestos WHERE creado_at >= '$fecha_inicio' AND fecha_fin <= '$fecha_fin' AND tipo_presupuesto = '$tipo_presupuesto'";
        $result = $this->db->query($query);
        $presupuesto_data = array();
        while ($row = $result->fetch_assoc()) {
            $presupuesto_data[] = $row;
        }
        return $presupuesto_data;
    }

    public function generatePDF($presupuesto_data) {
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(0, 10, 'Presupuesto', 1, 1, 'C');
        $this->pdf->Ln(10);

        foreach ($presupuesto_data as $item) {
            $this->pdf->Cell(0, 10, $item['descripcion'], 1, 1, 'L');
            $this->pdf->Cell(0, 10, $item['monto'], 1, 1, 'R');
            $this->pdf->Ln(10);
        }

        
        $pdf_content = $this->pdf->Output('', 'S');

        // Guardar el PDF en la db papu
        $query = "INSERT INTO pdfs (user_id, pdf_data, created_at) VALUES (?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ib", $_SESSION['user_id'], $pdf_content);
        $stmt->execute();

        return true;
    }
}
// Puede que acá haya un problema, no sé, vofi.
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$tipo_presupuesto = $_POST['tipo_presupuesto'];

$presupuesto = new Presupuesto();
$presupuesto_data = $presupuesto->getPresupuestos($fecha_inicio, $fecha_fin, $tipo_presupuesto);
$presupuesto->generatePDF($presupuesto_data);
