<?php

namespace App\Http\Controllers;

use App\Models\Logiciel;
use App\Models\Licence;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function generate($type)
    {
        $data = [];
        $reportTitle = '';

        switch ($type) {
            case 'logiciels':
                $data = Logiciel::with('utilisateur')->get();
                $reportTitle = 'Rapport des Logiciels';
                break;
            case 'licences':
                $data = Licence::with('logiciel')->get();
                $reportTitle = 'Rapport des Licences';
                break;
            case 'utilisateurs':
                $data = Utilisateur::all();
                $reportTitle = 'Rapport des Utilisateurs';
                break;
            default:
                return redirect()->back()->with('error', 'Type de rapport non valide.');
        }

        return view('reports.index', compact('data', 'reportTitle', 'type'));
    }

    public function export($type)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="report_' . $type . '_' . now()->format('Ymd_His') . '.csv"',
        ];

        $callback = function() use ($type) {
            $handle = fopen('php://output', 'w');

            switch ($type) {
                case 'logiciels':
                    fputcsv($handle, ['ID', 'Nom', 'Version', 'Description', 'Date d\'Installation', 'Utilisateur Responsable']);
                    foreach (Logiciel::with('utilisateur')->cursor() as $logiciel) {
                        fputcsv($handle, [
                            $logiciel->id_logiciel,
                            $logiciel->nom,
                            $logiciel->version,
                            $logiciel->description,
                            $logiciel->date_installation,
                            ($logiciel->utilisateur->nom ?? 'N/A') . ' ' . ($logiciel->utilisateur->prenom ?? ''),
                        ]);
                    }
                    break;
                case 'licences':
                    fputcsv($handle, ['ID', 'Logiciel', 'Clé Licence', 'Date Acquisition', 'Statut', 'Type Licence', 'Contrat']);
                    foreach (Licence::with('logiciel')->cursor() as $licence) {
                        fputcsv($handle, [
                            $licence->id_licence,
                            $licence->logiciel->nom ?? 'N/A',
                            $licence->cle_licence,
                            $licence->date_acquisition,
                            $licence->status,
                            $licence->type_licence,
                            $licence->contrat,
                        ]);
                    }
                    break;
                case 'utilisateurs':
                    fputcsv($handle, ['ID', 'Nom', 'Prénom', 'Email', 'Rôle']);
                    foreach (Utilisateur::cursor() as $utilisateur) {
                        fputcsv($handle, [
                            $utilisateur->id_utilisateur,
                            $utilisateur->nom,
                            $utilisateur->prenom,
                            $utilisateur->email,
                            $utilisateur->role,
                        ]);
                    }
                    break;
            }

            fclose($handle);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}