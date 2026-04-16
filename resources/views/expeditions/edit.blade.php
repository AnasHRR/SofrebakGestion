@extends('_layout')

@section('title', 'Modifier l\'Expédition - Sofrebak')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-8">

            <!-- Header -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1 fw-bold text-dark">
                        <i class="bi bi-pencil-square text-primary me-2"></i>Modifier l'Expédition #{{ $expedition->id }}
                    </h4>
                    <p class="text-muted small mb-0">Mettez à jour les informations de l'expédition sélectionnée.</p>
                </div>
                <a href="{{ route('expeditions.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                </a>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    @if ($errors->any())
                        <div class="alert alert-danger bg-danger-subtle text-danger border-0 rounded-3 mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('expeditions.update', $expedition->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">

                            <!-- Informations de l'Expédition -->
                            <div class="col-12">
                                <h6 class="text-primary text-uppercase fw-bold small mb-3 border-bottom pb-2">
                                    <i class="bi bi-info-circle me-2"></i>Informations de l'Expédition
                                </h6>
                            </div>

                            <!-- Chauffeur -->
                            <div class="col-md-6">
                                <label for="chauffeur_id" class="form-label fw-semibold">Chauffeur <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-person-badge"></i>
                                    </span>
                                    <select name="chauffeur_id" id="chauffeur_id" class="form-select border-start-0" required>
                                        <option value="" disabled>Sélectionner un chauffeur...</option>
                                        @foreach($chauffeurs as $chauffeur)
                                            <option value="{{ $chauffeur->id }}" {{ old('chauffeur_id', $expedition->chauffeur_id) == $chauffeur->id ? 'selected' : '' }}>
                                                {{ $chauffeur->nom_complet }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Numéro du Camion -->
                            <div class="col-md-6">
                                <label for="numero_camion" class="form-label fw-semibold">Numéro du Camion <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-truck-front"></i>
                                    </span>
                                    <input type="text" name="numero_camion" id="numero_camion" class="form-control border-start-0" value="{{ old('numero_camion', $expedition->numero_camion) }}" placeholder="Ex: 12345|A|1" required>
                                </div>
                            </div>

                            <!-- Date d'Expédition -->
                            <div class="col-md-6">
                                <label for="date_expedition" class="form-label fw-semibold">Date d'Expédition <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-calendar-date"></i>
                                    </span>
                                    <input type="date" name="date_expedition" id="date_expedition" 
                                        class="form-control border-start-0" 
                                        value="{{ old('date_expedition', $expedition->date_expedition ? \Carbon\Carbon::parse($expedition->date_expedition)->format('Y-m-d') : '') }}" required>
                                </div>
                            </div>

                            <!-- Statut de Livraison -->
                            <div class="col-md-6">
                                <label for="statut_livraison" class="form-label fw-semibold">Statut de Livraison <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-shield-check"></i>
                                    </span>
                                    <select name="statut_livraison" id="statut_livraison" class="form-select border-start-0" required>
                                        <option value="En cours" {{ old('statut_livraison', $expedition->statut_livraison) == 'En cours' ? 'selected' : '' }}>En cours</option>
                                        <option value="Livré" {{ old('statut_livraison', $expedition->statut_livraison) == 'Livré' ? 'selected' : '' }}>Livré</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Notes de Livraison -->
                            <div class="col-12">
                                <label for="notes_livraison" class="form-label fw-semibold">Notes de Livraison</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted align-items-start pt-2">
                                        <i class="bi bi-card-text"></i>
                                    </span>
                                    <textarea name="notes_livraison" id="notes_livraison" class="form-control border-start-0" rows="3" placeholder="Informations complémentaires...">{{ old('notes_livraison', $expedition->notes_livraison) }}</textarea>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 mt-5">
                                <hr class="my-4 opacity-10">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ route('expeditions.index') }}" class="btn btn-light px-4 fw-semibold text-muted">
                                        Annuler
                                    </a>
                                    <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                        <i class="bi bi-check-circle me-2"></i>Enregistrer les modifications
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .border-start-4 {
        border-left-width: 4px !important;
    }
    .form-control:focus, .form-select:focus {
        border-color: #6384ff;
        box-shadow: 0 0 0 0.25rem rgba(99, 132, 255, 0.1);
    }
    .input-group-text {
        transition: all 0.2s ease;
    }
    .input-group:focus-within .input-group-text {
        color: #6384ff !important;
        background-color: #fff !important;
        border-color: #6384ff !important;
    }
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-primary {
        background: linear-gradient(45deg, #1a1d2e, #4a5d99);
        border: none;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 132, 255, 0.3);
    }
</style>
@endsection