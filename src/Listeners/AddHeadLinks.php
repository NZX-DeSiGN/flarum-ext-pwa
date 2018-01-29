<?php
namespace NZX\Pwa\Listeners;

use Flarum\Event\ConfigureClientView;
use Flarum\Forum\UrlGenerator;
use Illuminate\Contracts\Events\Dispatcher;

class AddHeadLinks {
    protected $urlGenerator;

    public function __construct(UrlGenerator $urlGenerator) {
        $this->urlGenerator = $urlGenerator;
    }

    public function subscribe(Dispatcher $events) {
        $events->listen(ConfigureClientView::class, [$this, 'addAssets']);
    }

    public function addAssets(ConfigureClientView $event) {
        $rawHtml = file_get_contents(realpath(__DIR__ . '/../../templates/pwa.html'));
        $html = str_replace("%%BASE_URL%%", $this->urlGenerator->toBase(), $rawHtml);
        $html = str_replace("%%SW_URL%%", $this->urlGenerator->toPath('assets/extensions/nzx-design-pwa/js'), $html);
        $event->view->addHeadString($html);
    }
}
