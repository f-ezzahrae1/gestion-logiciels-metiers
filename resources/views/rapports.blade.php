@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h2>Rapports et Analyses</h2>
            <button class="btn-primary" onclick="exportReport()">
                <i class="fas fa-download"></i> Exporter rapport
            </button>
        </div>
        <div class="reports-container">
            <div class="report-card">
                <h3>Utilisation des logiciels</h3>
                <canvas id="software-usage-chart"></canvas>
            </div>
            <div class="report-card">
                <h3>Licences par statut</h3>
                <canvas id="license-status-chart"></canvas>
            </div>
        </div>
    </section>
@endsection
