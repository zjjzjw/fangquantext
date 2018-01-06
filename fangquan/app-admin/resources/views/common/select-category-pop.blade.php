<script type="text/html" id="categoriesTpl">
    <div class="categories-box">
        <p class="cancel-pop">x</p>
        <ul class="first-level">
            @foreach($categories ?? [] as $key=> $category)
                <li data-type="{{$key}}">
                    <a href="JavaScript:void(0);">{{$category['name']}}</a>
                </li>
            @endforeach
        </ul>

        {{--二级 -e--}}
        <div class="categories-content {{$name}}">
            @foreach($categories  ?? [] as $key=> $secondCategory)
                <ul class="second-level" data-node="{{$key}}" style="display: none;">
                    @foreach($secondCategory['nodes'] ?? [] as $key => $threeCategory)
                        <li>
                            <a href="JavaScript:void(0);">{{$threeCategory['name']}}</a>
                            {{--三级 -s--}}
                            <ul class="three-level">
                                @foreach($threeCategory['nodes'] ?? [] as $node)
                                    <li>
                                        {{--1是单选 2是多选--}}
                                        <input id="{{$name}}_{{$node['id']}}" data-id="{{$node['id']}}"
                                               @foreach($categories_ids ?? [] as $ids)
                                                    @if($node['id'] == $ids)checked="checked" @endif
                                               @endforeach
                                                    class="type-detail"
                                               @if($type ==1)
                                                    type="radio"
                                               @else
                                                    type="checkbox"
                                               @endif
                                               name="{{$name}}"
                                               value="<?= $node['name'] ?>"/>
                                        <label for="{{$name}}_<?= $node['id'] ?>"><?= $node['name'] ?></label>
                                    </li>
                                @endforeach
                            </ul>
                            {{--三级 -e--}}
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
        {{--二级 -s--}}
        <div class="categories-footer">
            <a href="javascript:void(0);" class="button {{$name}}-confirm">确定</a>
        </div>
    </div>
</script>