package com.example.asus.bubt;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by Asus on 7/17/2018.
 */

public class NewsAdapter extends BaseAdapter {
    ArrayList<News> arrayList;
    Context context;

    public NewsAdapter(ArrayList<News> arrayList, Context context) {
        this.arrayList = arrayList;
        this.context = context;
    }

    @Override
    public int getCount() {
        return arrayList.size();
    }

    @Override
    public Object getItem(int position) {
        return arrayList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        final News member;
        ViewHolder viewHolder;

        if(convertView==null){
            viewHolder = new ViewHolder();
            LayoutInflater inflater = LayoutInflater.from(context);
            convertView = inflater.inflate(R.layout.newslist, null);
            viewHolder.textNews = (TextView) convertView.findViewById(R.id.txtNews);
            convertView.setTag(viewHolder);

        }else{

            viewHolder = (ViewHolder) convertView.getTag();
        }

        member = arrayList.get(position);
        viewHolder.textNews.setText(member.getNews());
        return convertView;
    }
    private class ViewHolder{
        TextView textNews;
    }
}
