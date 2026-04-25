@extends('_layout')

@section('title', 'Modifier l\'Expédition')

@section('content')
    <style>
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.6rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header-left h2 {
            font-size: 1.35rem;
            font-weight: 800;
            color: #0f1e4a;
            margin: 0;
            letter-spacing: -0.4px;
        }

        .page-header-left p {
            font-size: 0.82rem;
            color: #64748b;
            margin: 0.2rem 0 0;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: #fff;
            color: #64748b;
            font-size: 0.84rem;
            font-weight: 700;
            padding: 0.55rem 1.1rem;
            border-radius: 10px;
            text-decoration: none;
            border: 1.5px solid #e2eaf8;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background: var(--blue-50);
            border-color: var(--blue-100);
            color: var(--blue-600);
            transform: translateY(-1px);
        }

        .form-card {
            background: #ffffff;
            border: 1px solid #e2eaf8;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(15, 42, 110, 0.06);
            overflow: hidden;
            padding: 2rem;
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #64748b;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control, .form-select {
            padding: 0.65rem 1rem;
            border: 1.5px solid #e2eaf8;
            border-radius: 10px;
            font-size: 0.9rem;
            color: #1e293b;
            width: 100%;
            transition: all 0.2s;
            background-color: #f8fafc;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--blue-400);
            background-color: #fff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            font-weight: 800;
            color: #0f1e4a;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f1f5fb;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            color: #fff;
            font-size: 0.88rem;
            font-weight: 700;
            padding: 0.7rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(29, 78, 216, 0.35);
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-submit:hover {
            box-shadow: 0 6px 20px rgba(29, 78, 216, 0.5);
            transform: translateY(-1px);
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
        }
    </style>

    <div class="page-header">
        <div class="page-header-left">
            <h2><i class="bi bi-pencil-square me-2" style="color:var(--blue-500);"></i>Modifier l'Expédition #{{ $expedition->id }}</h2>
            <p>Mettez à jour les informations de l'expédition</p>
        </div>
        <a href="{{ route('expeditions.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    @if ($errors->any())
        <div class="alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form action="{{ route('expeditions.update', $expedition->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="section-title">
                <i class="bi bi-info-circle-fill" style="color:var(--blue-500);"></i>
                Informations Générales
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label for="chauffeur_id" class="form-label">Chauffeur</label>
                    <select name="chauffeur_id" id="chauffeur_id" class="form-select" required>
                        <option value="" disabled>Sélectionner un chauffeur...</option>
                        @foreach($chauffeurs as $chauffeur)
                            <option value="{{ $chauffeur->id }}" {{ old('chauffeur_id', $expedition->chauffeur_id) == $chauffeur->id ? 'selected' : '' }}>
                                {{ $chauffeur->nom_complet }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="numero_camion" class="form-label">Numéro du Camion</label>
                    <select name="numero_camion" id="numero_camion" class="form-select" required>
                        <option value="" disabled>Sélectionner un camion...</option>
                        <option value="21872|A|15" {{ old('numero_camion', $expedition->numero_camion) == '21872|A|15' ? 'selected' : '' }}>21872|A|15</option>
                        <option value="64521|B|18" {{ old('numero_camion', $expedition->numero_camion) == '64521|B|18' ? 'selected' : '' }}>64521|B|18</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="date_expedition" class="form-label">Date d'Expédition</label>
                    <input type="date" name="date_expedition" id="date_expedition" class="form-control" 
                           value="{{ old('date_expedition', $expedition->date_expedition ? \Carbon\Carbon::parse($expedition->date_expedition)->format('Y-m-d') : '') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="statut_livraison" class="form-label">Statut de Livraison</label>
                    <select name="statut_livraison" id="statut_livraison" class="form-select" required>
                        <option value="En cours" {{ old('statut_livraison', $expedition->statut_livraison) == 'En cours' ? 'selected' : '' }}>En cours</option>
                        <option value="Livré" {{ old('statut_livraison', $expedition->statut_livraison) == 'Livré' ? 'selected' : '' }}>Livré</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="notes_livraison" class="form-label">Notes de Livraison</label>
                    <textarea name="notes_livraison" id="notes_livraison" class="form-control" rows="3" 
                              placeholder="Informations complémentaires sur la livraison...">{{ old('notes_livraison', $expedition->notes_livraison) }}</textarea>
                </div>
            </div>

            <div style="margin-top: 2.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="{{ route('expeditions.index') }}" style="display:inline-flex; align-items:center; text-decoration:none; color:#64748b; font-weight:700; font-size:0.85rem;">
                    Annuler
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
@endsection