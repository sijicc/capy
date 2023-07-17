<?php

namespace App\Http\Livewire\Announcements;

use App\Models\Announcement;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Redirector;

class Create extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $title = '';
    public $content = '';
    public $should_notify = false;
    public $should_email = false;
    public $publish_at;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\MarkdownEditor::make('content')->required(),
            Forms\Components\Checkbox::make('should_notify'),
            Forms\Components\Checkbox::make('should_email'),
            Forms\Components\DateTimePicker::make('publish_at')
                ->afterOrEqual('today'),
        ];
    }

    public function submit(): RedirectResponse|Redirector
    {
        $this->validate();

        $announcement = Announcement::create([
            'title' => $this->title,
            'content' => $this->content,
            'should_notify' => $this->should_notify,
            'should_email' => $this->should_email,
            'publish_at' => $this->publish_at ?? now(),
            'user_id' => auth()->user()->id,
        ]);

        if ($announcement->publish_at <= now()) {
            $announcement->publish();
        }

        return redirect()->route('announcements.index');
    }

    public function render(): View
    {
        return view('livewire.announcements.create');
    }
}
