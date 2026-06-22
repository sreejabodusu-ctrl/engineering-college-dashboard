import streamlit as st
import pandas as pd
import mysql.connector
import plotly.express as px

# Page Config
st.set_page_config(
    page_title="Engineering College Analytics Dashboard",
    page_icon="🎓",
    layout="wide"
)

st.title("🎓 Engineering College Analytics Dashboard")

# MySQL Connection
@st.cache_resource
def get_connection():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="engineering_college"
    )

conn = get_connection()

# Load Student Data
query = "SELECT * FROM Student"
df = pd.read_sql(query, conn)

# Sidebar
st.sidebar.header("Filters")

branches = st.sidebar.multiselect(
    "Select Branch",
    options=df["branch"].unique(),
    default=df["branch"].unique()
)

filtered_df = df[df["branch"].isin(branches)]

# KPI Cards
col1, col2, col3 = st.columns(3)

with col1:
    st.metric("Total Students", len(filtered_df))

with col2:
    st.metric("Branches", filtered_df["branch"].nunique())

with col3:
    st.metric(
        "Average Year",
        round(filtered_df["year_of_study"].mean(), 1)
    )

st.divider()

# Student Data
st.subheader("📋 Student Records")
st.dataframe(filtered_df, use_container_width=True)

st.divider()

# Branch Distribution
st.subheader("📊 Students by Branch")

branch_counts = (
    filtered_df["branch"]
    .value_counts()
    .reset_index()
)

branch_counts.columns = ["Branch", "Students"]

fig1 = px.bar(
    branch_counts,
    x="Branch",
    y="Students",
    title="Students per Branch"
)

st.plotly_chart(fig1, use_container_width=True)

# Year Distribution
st.subheader("📈 Students by Year")

year_counts = (
    filtered_df["year_of_study"]
    .value_counts()
    .sort_index()
    .reset_index()
)

year_counts.columns = ["Year", "Students"]

fig2 = px.line(
    year_counts,
    x="Year",
    y="Students",
    markers=True,
    title="Student Distribution by Year"
)

st.plotly_chart(fig2, use_container_width=True)

# Pie Chart
st.subheader("🥧 Branch Share")

fig3 = px.pie(
    branch_counts,
    names="Branch",
    values="Students",
    hole=0.4
)

st.plotly_chart(fig3, use_container_width=True)

# Search Student
st.subheader("🔍 Search Student")

search = st.text_input("Enter Student Name")

if search:
    result = filtered_df[
        filtered_df["student_name"]
        .str.contains(search, case=False, na=False)
    ]

    st.dataframe(result, use_container_width=True)

# Download Data
st.subheader("⬇ Download Data")

csv = filtered_df.to_csv(index=False)

st.download_button(
    label="Download CSV",
    data=csv,
    file_name="students.csv",
    mime="text/csv"
)