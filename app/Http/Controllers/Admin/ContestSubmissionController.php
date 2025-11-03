<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContestSubmission;
use Illuminate\Http\Request;

class ContestSubmissionController extends Controller
{
    public function index()
    {
        $submissions = ContestSubmission::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.contest-submissions.index', compact('submissions'));
    }

    public function show($id)
    {
        $submission = ContestSubmission::findOrFail($id);

        return view('admin.contest-submissions.show', compact('submission'));
    }

    public function destroy($id)
    {
        $submission = ContestSubmission::findOrFail($id);
        $submission->delete();

        return redirect()->route('admin.contest-submissions.index')
            ->with('success', 'Participation supprimée avec succès');
    }

    public function export()
    {
        $submissions = ContestSubmission::orderBy('created_at', 'desc')->get();

        $filename = 'concours_participations_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($submissions) {
            $file = fopen('php://output', 'w');

            // BOM UTF-8 pour Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // En-têtes
            fputcsv($file, [
                'ID',
                'Date',
                'Nom/Prénom',
                'Email',
                'Téléphone',
                'Statut',
                'Activité',
                'Besoins',
                'Budget',
                'Deadline',
                'Message',
                'RGPD',
                'Marketing',
                'UTM Source',
                'UTM Medium',
                'UTM Campaign'
            ], ';');

            // Données
            foreach ($submissions as $submission) {
                fputcsv($file, [
                    $submission->id,
                    $submission->created_at->format('d/m/Y H:i'),
                    $submission->nom_prenom,
                    $submission->email,
                    $submission->telephone ?? '',
                    $submission->statut,
                    $submission->activite,
                    $submission->besoins,
                    $submission->budget,
                    $submission->deadline,
                    $submission->message ?? '',
                    $submission->consent_rgpd ? 'Oui' : 'Non',
                    $submission->opt_in_marketing ? 'Oui' : 'Non',
                    $submission->utm_source ?? '',
                    $submission->utm_medium ?? '',
                    $submission->utm_campaign ?? ''
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
