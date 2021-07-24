<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-detail-activity-{{ $data->id }}">
  Show
</button>

<div class="modal text-left fade" id="modal-detail-activity-{{ $data->id }}" tabindex="-1" aria-labelledby="modal-detail-activity-{{ $data->id }}Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="modal-detail-activity-{{ $data->id }}Label">Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="table-responsive">
        <table class="table table-sm" width="100%">
          <tbody>
            <tr>
              <td colspan="2">
                <p class="card-title font-weight-bold my-2">User Account</p>
              </td>
            </tr>
            <tr>
              <td width="200">Date</td>
              <td>{{ $data->created_at }}</td>
            </tr>
            <tr>
              <td>Name</td>
              <td>{{ $data->name }}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>{{ $data->email }}</td>
            </tr>

            <tr>
              <td>Event Type</td>
              <td>
                <span class="badge badge-{{ $colors[$data->type] ?? 'warning' }}">
                  {{ ucwords($data->type) }}
                </span>
              </td>
            </tr>

            <tr>
              <td>Model</td>
              <td>{{ ucwords($data->logable_type) }}</td>
            </tr>
            <tr>
              <td>ID</td>
              <td>{{ ucwords($data->logable_id) }}</td>
            </tr>
            <tr>
              <td colspan="2">
                <p class="card-title font-weight-bold my-2">New Data</p>
              </td>
            </tr>

            @foreach($data->new_data as $field => $new)
              @php
                  $old = isset($data->old_data[$field]) ? $data->old_data[$field] : $new;
              @endphp
              <tr>
                <td>{{ $field }}</td>
                <td class="{{ ($old === $new) ? '' : 'text-danger' }}">{!!  $new !!}</td>
              </tr>
            @endforeach

            <tr>
              <td colspan="2">
                <p class="card-title font-weight-bold my-2">Old Data</p>
              </td>
            </tr>

            @forelse($data->old_data as $field => $old)
              @php
                  $new = isset($data->new_data[$field]) ? $data->new_data[$field] : $old;
              @endphp
              <tr>
                <td>{{ $field }}</td>
                <td class="{{ ($old === $new) ? '' : 'text-warning' }}">{!!  $old !!}</td>
              </tr>
            @empty 
              <tr>
                <td colspan="2">No data available</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>