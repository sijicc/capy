<?php

namespace App\Http\Livewire\Announcements;

use App\Models\Announcement;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Redirector;

class EditAnnouncement extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Announcement $announcement;
    public $title = '';
    public $content = '';
    public $should_notify = false;
    public $should_email = false;
    public $publish_at;

    public function mount()
    {
        $this->form->fill([
            'title' => $this->announcement->title,
            'content' => $this->announcement->content,
            'should_notify' => $this->announcement->should_notify,
            'should_email' => $this->announcement->should_email,
            'publish_at' => $this->announcement->publish_at,
        ]);
    }

    public function render(): View
    {
        return view('livewire.announcements.edit-announcement');
    }

    public function submit(\App\Actions\EditAnnouncement $editAnnouncement): RedirectResponse|Redirector
    {
        $editAnnouncement->handle($this->announcement, [
            'title' => $this->title,
            'content' => $this->content,
            'should_notify' => $this->should_notify,
            'should_email' => $this->should_email,
            'publish_at' => $this->publish_at,
        ]);

        return redirect()->route('announcements.index');
    }

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

}
