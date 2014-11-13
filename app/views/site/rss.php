<div id="polling" ng-show="polling">
    Loading
</div>
<div id="network-error" ng-show="networkError">
    No Network
</div>
<div ng-controller='rssController'  ng-app="rssReader" ng-init="getData()">
    <ul class='rss-entries'>
        <li class='rss-entry' ng-repeat='rssEntry in rssEntries'>
            <h2 class='title'>
                <a href='{{rssEntry.link}}' target='_blank'>{{rssEntry.title}}</a>
            </h2>
            &middot;
            <i class='published-date'>{{rssEntry.publishedDate | date:'medium' }}</i>
            &middot;
            <div class='body'>
                {{rssEntry.contentSnippet}}
            </div>
        </li>
    </ul>
</div>