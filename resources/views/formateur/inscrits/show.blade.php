<div class="row g-3">
    <div class="col-md-6">
        <span class="text-muted small">Email</span>
        <div class="fw-semibold">{{ $inscrit['email'] }}</div>
    </div>
    <div class="col-md-6">
        <span class="text-muted small">Inscrit le</span>
        <div class="fw-semibold">{{ \Carbon\Carbon::parse($inscrit['date_inscription'])->format('d/m/Y') }}</div>
    </div>
    <div class="col-12">
        <span class="text-muted small">Progression globale</span>
        <div class="d-flex align-items-center gap-2">
            <div class="progress flex-grow-1" style="height: 8px;">
                <div class="progress-bar bg-success" style="width: {{ $inscrit['progression'] }}%;"></div>
            </div>
            <span class="fw-bold">{{ $inscrit['progression'] }}%</span>
        </div>
    </div>
    <div class="col-12">
        <hr>
        <h6 class="fw-bold">Formations suivies</h6>
        <ul class="list-group list-group-flush">
            @foreach($inscrit['formations'] as $f)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $f['titre'] }}
                    <span class="badge {{ $f['statut'] == 'Terminé' ? 'bg-success' : 'bg-primary' }}">{{ $f['statut'] }} ({{ $f['progression'] }}%)</span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-12">
        <h6 class="fw-bold">Quiz tentés</h6>
        <ul class="list-group list-group-flush">
            @foreach($inscrit['quiz'] as $q)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $q['titre'] }}
                    <span class="badge {{ $q['reussi'] ? 'bg-success' : 'bg-danger' }}">{{ $q['score'] }}%</span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-12">
        <h6 class="fw-bold">Certificats obtenus</h6>
        <ul class="list-group list-group-flush">
            @foreach($inscrit['certificats'] as $c)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $c['titre'] }}
                    <span class="text-muted small">{{ \Carbon\Carbon::parse($c['date'])->format('d/m/Y') }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>